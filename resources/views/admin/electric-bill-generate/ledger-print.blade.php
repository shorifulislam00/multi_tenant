<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Ledger Print</title>
    <!-- Including CSS styles -->

     @include('admin.layouts.style')
</head>

<body>
    <table border="0px" width="98%" align="center" style="border-collapse:collapse; margin-top: 20px;" id="tbl">
        <tr style="background: rgb(250, 249, 249);">
            <!-- Header section -->
            <td style="text-align: center;" colspan="8">
                <h3 style="margin-bottom: 10px;">Multi Tenant</h3>
                <strong style="margin-top: 20px;">Dhaka, Bangladesh</strong>
                <h3 style="text-decoration: underline;">Bill Ledger</h3>
                  <!-- Date range -->
                @if(request("from_date"))
                <h3>
                    Date :  From  {{ request('from_date') }}    To {{ request('to_date') }}
                </h3>
                @endif
            </td>

        </tr>
            @if(!empty($flat_rent))
            <tr style="background: rgb(250, 249, 249);">
                <td colspan="1" style="text-align: left; padding-left: 10px; padding:6px;">
                    Tenant name : {{ $flat_rent->tenant_name }} &emsp;&emsp;

                </td>
                <td colspan="4" style="text-align: left; padding-left: 10px; padding:6px;">
                    Mobile Number : {{ $flat_rent->mobile_no }} &emsp;&emsp;


                </td>
                <td colspan="1" style="text-align: left; padding-left: 10px; padding:6px;">
                    Address : {{ $flat_rent->address }} &emsp;&emsp;

                </td>

            </tr>
        @endif



                <tr style="background: #d0d0d0;font-weight: bold;">
                    <th>Date</th>
                    <th>Description</th>
                    <th>Comment </th>
                    <th>Debit</th>
                    <th>Credit</th>
                    <th>Balance</th>

                </tr>
            {{--</thead> --}}

            <tbody>

                @php

                    $total_dr = $previous_balance > 0 ? $previous_balance : 0;
                    $total_cr = $previous_balance < 0 ? $previous_balance : 0;


                    $total_balance = $total_dr - $total_cr;
                @endphp


                <tr>


                        <td style="text-align:center;padding-left:10px;" colspan="3">
                            Previous Jer / Balance B/D / {{ $previous_balance >= 0 ? "Previous due" : "Previous revenue" }}

                        </td>

                        <td style="text-align: right;padding-right:10px;">
                            {{ $previous_balance < 0 ? number_format($previous_balance, 0, '.', ',')  : ''}}
                        </td>

                        <td style="text-align: right;padding-right:10px;">
                            {{ $previous_balance > 0 ? number_format($previous_balance, 0, '.', ',') : ''}}
                        </td>
                        <td style="text-align: right;padding-right:10px;">

                            @if($previous_balance > 0)
                                {{ number_format($previous_balance, 0, '.', ',') }}
                            @else
                                {{ number_format($previous_balance, 0, '.', ',') }}
                            @endif

                        </td>


                </tr>

                @foreach($data as $item)
                    @php
                        $total_dr += $item->dr;
                        $total_cr += $item->cr;
                        $total_balance = $total_dr - $total_cr ;
                    @endphp

                    <tr>
                        <td>{{ date("d-m-Y", strtotime($item->action_date)) }}</td>

                        <td style="text-align:left;padding-left:10px;">
                            {{ $item->account_id ? "Payment" :  "Rent Bill"  }}

                        </td>

                        <td style="text-align: right;padding-right:10px;">


                            {{ !empty($item->comment) ? $item->comment : '' }}


                        </td>

                        <td style="text-align: right;padding-right:10px;">

                            {{ $item->dr ? number_format($item->dr, 0, '.', ',')  : '' }}

                        </td>



                        <td style="text-align: right;padding-right:10px;">
                            {{ $item->cr ? number_format($item->cr, 0, '.', ',')  : '' }}
                        </td>


                        <td style="text-align: right;padding-right:10px;">

                                @if($item->cr)
                                    {{  number_format(($previous_balance = $previous_balance - $item->cr), 0, '.', ',')  }}
                                @else
                                    {{  number_format(($previous_balance = $previous_balance + $item->dr), 0, '.', ',')  }}
                                @endif
                        </td>
                    </tr>




                @endforeach

            </tbody>

            {{--<tfoot>--}}
                <tr>
                    <td colspan="3" style="text-align: right;padding-right:10px"><strong>Total :</strong> </td>

                    <td style="text-align: center;">

                        {{ number_format($total_dr, 0, '.', ',') }}

                    </td>

                    <td style="text-align: center;">

                        {{ number_format($total_cr, 0, '.', ',') }}


                    </td>

                    <td style="text-align: center;">
                        {{ number_format($total_balance, 0, '.', ',') }}
                    </td>
                </tr>


        {{--</tfoot>--}}

        </table>
    {{-- </div> --}}
</body>
</html>
