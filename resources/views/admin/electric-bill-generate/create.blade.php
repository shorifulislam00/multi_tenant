@extends('admin.layouts.app')

@section('title', 'Bill Generate')

@section('content')
    <div class="app-main__inner">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 px-1">
                    <div class="card">
                        <div class="text-center mt-2" style="display: block;">
                            @php
                                use Carbon\Carbon;
                            @endphp

                            <h5>


                                {{ $house->name }} <br/>
                                {{ $house->address }} <br/>
                                Electric Meter Reading <br/>
                                @php
                                    $monthId = $data[0]->electric_meter_reading[0]->month_id;
                                    $yearId = $data[0]->electric_meter_reading[0]->year_id;
                                    $monthName = Carbon::create()->month($monthId)->format('F');
                                @endphp
                                {{ $monthName }}, {{ $yearId }}
                            </h5>
                        </div>

                        <div class="card-body">
                            <form id="electricMeterReadingForm" >
                                @csrf
                                <input type="hidden" id="house_id" name="house_id" value="{{ request('house_id') }}">
                                <input type="hidden" id="month_id" name="month_id" value="{{ request('month_id') }}">
                                <input type="hidden" id="year_id" name="year_id" value="{{ request('year_id') }}" >

                                <table class="table table-striped" id="table-data">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Floor Name') }}</th>
                                            <th>{{ __('Flat Name') }}</th>
                                            <th>{{ __('Tennat Name') }}</th>
                                            <th>{{ __('Previous Reading') }}</th>
                                            <th>{{ __('Present Reading') }}</th>
                                            <th>{{ __('Consuming Unit') }}</th>
                                            <th>{{ __('Rate') }}</th>
                                            <th>{{ __('Amount') }}</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach($data as $key => $item)


                                            <tr>
                                                <td>{{ $item->floor->name }}</td>
                                                <td>{{ $item->flat->flat_number }}</td>
                                                <td>{{ $item->tenant_name }}</td>
                                                <td id="previous_reading">
                                                    {{ $previous_reading =  $item->electric_meter_reading[0]->previous_meter_reading
                                                    }}

                                                    <input type="hidden" name="meter_pid[]" id="meter_pid{{$key}}" value="{{$item->electric_meter_reading[0]->id}}" />

                                                    <input type="hidden" name="previous_reading[]" id="previous_reading{{$key}}" value="{{$previous_reading}}" />

                                                </td>

                                                <td>
                                                    <input name="present_reading[]" id="present_reading{{ $key }}" class="form-control" value="{{ $item->electric_meter_reading[0]->present_meter_reading }}" onchange="calculateConsumingUnit({{ $key  }})" />
                                                </td>

                                                <td>
                                                    <span class="consuming_unit"  id="consuming_unit{{ $key }}" >{{ $extReading = $item->electric_meter_reading[0]->present_meter_reading - $item->electric_meter_reading[0]->previous_meter_reading }}</span>

                                                    <input type="hidden" name="consuming_unit[]" id="consuming_unit1{{$key}}" />
                                                </td>

                                                <td>
                                                    @if($item->flat->type == 'shop')
                                                    {{ $rate = $house->business_electric_bill }}
                                                    @elseif($item->flat->type == 'apartment')
                                                    {{ $rate = $house->domestic_electric_bill }}
                                                    @endif

                                                    <input type="hidden" name="rate[]" id="rate{{$key}}" value="{{$rate}}" />
                                                </td>

                                                <td>
                                                    <span class="amount" id="amount{{ $key }}">
                                                        {{ $extReading * $rate }}
                                                    </span>

                                                    <input type="hidden" name="amount[]" id="amount{{$key}}" value="{{ $extReading * $rate }}" />

                                                </td>

                                                <td>

                                                    <input type="hidden" name="flatrent_id[]" id="flatrent_id{{$key}}" value="{{$item->id}}" />

                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                                <div class="text-center">
                                    <button id="submitForm"  type="submit" class="btn btn-primary text-center">Submit</button>
                                </div>
                            </form=>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection




@section('scripts')

    <script type="text/javascript">

        $(document).ready(function() {


            // __form data for update and create__ //
            $('#submitForm').click(function(e) {
                e.preventDefault();

                var formData = $('#electricMeterReadingForm').serialize();

                // __cosuming unit add the formData__ //
                $('span[id^="consuming_unit"]').each(function() {
                    var id = $(this).attr('id').replace('consuming_unit', '');
                    var value = $(this).text();
                    formData += `&consuming_unit[${id}]=${value}`;
                });

                // __amount add the formData__ //
                $('span[id^="amount"]').each(function() {
                    var id = $(this).attr('id').replace('amount', '');
                    var value = $(this).text();
                    formData += `&amount[${id}]=${value}`;
                });

                $.ajax({
                    url: "{{ route('bill.store') }}",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        if(response.status == 'success'){
                            toastr.success(response.message);

                            // __ set time and redirect __ //
                            window.location.href = response.redirect_url;

                        } else {
                            toastr.error(response.message)
                        }

                    },
                    error: function(err) {
                        console.error('Error occurred:', err.responseText);

                    }
                });
            });
        });

        // __calculate consuming unit__ //
        function calculateConsumingUnit(key) {
            var presentReading = $('#present_reading' + key).val();
            var previousReading = $('#previous_reading' + key).val();

            var consumingUnit = presentReading - previousReading;
            $('#consuming_unit' + key).text(consumingUnit);
            calculateAmount(key, consumingUnit);
        }

        function calculateAmount(key, consumingUnit) {
            var rate = parseFloat($('#rate' + key).val());
            var amount = consumingUnit * rate;
            $('#amount' + key).text(amount.toFixed(2));
        }

        // __present reading input__ //
        $('input[name^="present_reading"]').on('input', function() {
            var key = $(this).attr('id').replace('present_reading', '');
            var presentReading = parseFloat($(this).val());
            var previousReading = parseFloat($('#previous_reading' + key).val());
            var consumingUnit = presentReading - previousReading;
            $('#consuming_unit' + key).text(consumingUnit);
            calculateAmount(key, consumingUnit);
        });





    </script>



@endsection





