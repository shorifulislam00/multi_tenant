<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Bill Print</title>
    <link rel="stylesheet" href="style.css" media="all" />
    <style>

        .clearfix:after {
        content: "";
        display: table;
        clear: both;
        }

        a {
        color: #5D6975;
        text-decoration: underline;
        }

        body {
        position: relative;
        margin: 0 auto;
        color: #001028;
        background: rgb(249, 251, 251);
        font-family: Arial, sans-serif;
        font-size: 10px;
        font-family: Arial;
      }

        .invoice-container {
          width: 48%;
          margin: 5px;
          float: left;
          border: 1px solid black;
        }

        header {
        padding: 10px 0;
        }

        h5 {
        border-bottom: 1px solid  #5D6975;
        color: #5D6975;
        font-size: 1.4em;
        line-height: 1.4em;
        text-align: center;
        margin: 0 0 20px 0;

        }

        #house,
        #company {
        white-space: nowrap;
        padding-left: 5px;
        }

        #house{
            margin-top: -10px;
            margin-left: 5px;
        }

        #house span {
            color: black;
            text-align: left;
            width: 30px;
            margin-right: 5px;
            font-size: 0.8em;
            display: inline-block;
        }

        #company{
            float: right;
            margin-right: 5px;
            margin-top: -10px;
        }
        #company span {
            color: black;
            text-align: left;
            width: 30px;
            margin-right: 5px;
            font-size: 0.8em;
            display: inline-block;
        }



        table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 10px;

        }

        table th,
        table td {
        text-align: center;
        margin-left: 10px;
        }

        table th {
        padding: 5px;
        color: #5D6975;
        border-bottom: 1px solid #C1CED9;
        white-space: nowrap;
        font-weight: normal;
        margin-left: 10px;
        }

        table .service,
        table .desc {
        text-align: left;
        }

        table td {
        padding: 5px;
        text-align: right;
        }

        table td.service,
        table td.desc {
        vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
        font-size: 11px;
        }

        table td.grand {
        border-top: 1px solid #5D6975;;
        }

        #notices .notice {
        color: #5D6975;
        font-size: 1.2em;
        }

    </style>
  </head>
  <body>

    @foreach ($data as $item)
      <div class="invoice-container">
        <header class="clearfix">
          <h5>INVOICE </h5>
          <div id="company" class="clearfix">
            <div><span style="margin-bottom: 3px;"> Apartment details</span></div>
            <div><span style="margin-right: 5px">Flat no. </span>{{ $item->flatRent ? $item->flatRent->flat->flat_number : '' }}</div>
            <div><span style="margin-right: 5px">Floor no.  </span> {{ $item->flatRent ?  $item->flatRent->floor->name : '' }}</div>
            <div><span style="margin-right: 5px">House  </span> {{ $item->flatRent ? $item->flatRent->house->name : ''}}</div>
            <div><span style="margin-right: 5px">Date  </span> {{ $item->action_date }}</div>
            <div><span style="margin-right: 5px">Status  </span> {{ ($item->is_paid == 0) ? "Not Paid" : "Paid"}}</div>

        </div>
          <div id="house">
              <div>Billed To:</div>
              <div><span>Name</span>{{ $item->flatRent ? $item->flatRent->tenant_name : '' }}</div>
              <div><span>Mobile</span>{{ $item->flatRent ? $item->flatRent->mobile_no : '' }}</div>
              <div><span>Email</span>{{ $item->flatRent ? $item->flatRent->email : '' }}</div>
              <div><span>Month</span>{{ date('F', mktime(0, 0, 0, $item->month_id, 1)) }}</div>
              <div><span>Year</span>{{ $item->year_id }}</div>
          </div>
        </header>
        <table>
          <thead>
            <tr>
              <th colspan="4" style="padding-left: 10px" class="service">Description</th>
              <th colspan="4" style="text-align: right;">TOTAL</th>
            </tr>
          </thead>
          <tbody>
            @php
              $billItem = DB::table("flat_rent_details")
                              ->join("rent_bill_configs", function($join) use($item){
                                  $join->on("rent_bill_configs.id", "=", "flat_rent_details.rent_bill_config_id")
                                      ->where("flat_rent_details.bill_id", $item->id);
                              })
                              ->join("bill_configs", "bill_configs.id", "=", "rent_bill_configs.bill_config_id")
                              ->select("bill_configs.name", "flat_rent_details.amount")
                              ->get();
            @endphp
            @foreach ($billItem as $bitem)
              <tr>
                <td colspan="4" style="text-align: left; padding-left:10px;">{{ $bitem->name }}</td>
                <td colspan="4" class="total">{{ number_format($bitem->amount, 0) }}
                </td>
              </tr>
            @endforeach
            <tr>
              <td colspan="4" class="grand total">Total</td>
              <td colspan="4" class="grand total">{{ number_format($item->amount, 0) }}
            </td>
            </tr>
          </tbody>
        </table>

        <div class="footer">
            <div style="float: left; border-top:1px solid black; margin-left:10px;"><p style="margin-top: 0px" >Depositor signature</p></div>

            <div style="float: right; border-top:1px solid black; margin-right:10px;"><p style="margin-top: 0px">Receiver signature</p></div>
        </div>


      </div>


    @endforeach
  </body
