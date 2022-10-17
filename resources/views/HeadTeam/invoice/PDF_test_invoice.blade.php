<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SHOW PDF INVOICE'S</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <style>
        body{
            font-size:12px;
            font-style: sans-serif;
            /* "Roboto", Helvetica Neue, Helvetica, Arial,  */
        }
        .header{
            margin-bottom:50px;
        }
        .row {
            width: 100%;
            margin-bottom:50px;
        }
        .left_side {
            width: 45%; 
            height: 100px; 
            float: left;
        }
        .right_side{
            margin-left:46%;
            width: 50%; 
            height: 100px;
        }

        #theTable {
            font-size:11px;
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #theTable td, #theTable th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #theTable th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #19e5e6;
            color: white;
        }

    </style>
	<!-- /core JS files -->
</head>
<body>
    <div class="row">
        <img src="{{ base_path().'/public/assets/images/invoices_header_new.png' }}" alt="header invoices refast indonesia" style="widht:100%;">
    </div>

    <!-- <div class="header">
        <div class="col-md-5">
            <div>
                <div class="col-md-12">
                    <b>PT. REFAST INDONESIA</b><br>
                    <i>Civil Mechanical and Electrical Contractor</i>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div>
                <div class="col-md-12">
                    <b class="text-info" style="float:right; font-size:20px; color:00FFFF; margin-top:-10px;">INVOICE</b><br>
                </div>
            </div>
        </div>
    </div> -->

    <div class="row">
        <div class="left_side"> 
            <b>Workshop:</b><br>
            <p>
                Jl. Gas Alam Raya No. 19 <br>
                Cimanggis, Depok, Jawa Barat <br>
                Ph & Fax : +62 21 874 3234 
            </p>
            <b>
                CP: NURAINI ( nuraini@refastindo.com )
            </b>
            <br><br> 
            <span style="">
                <p>
                    NPWP PT REFAST INDONESIA <br>		
                    31.373.137.4.412.000
                </p>
            </span>
        </div>

        <div class="right_side"> 
            <table>
                <tr>
                    <td>INVOICE NO</td>
                    <td>:</td>
                    <td>{{ $datanya['data_invoice']->no_invoice }}</td>
                </tr>
                <tr>
                    <td>DATE</td>
                    <td>:</td>
                    <td><?= date("M d, Y", strtotime($datanya['data_invoice']->created_at)) ?></td>
                </tr>
                <tr>
                    <td>DUE DATE</td>
                    <td>:</td>
                    <td><?= date("M d, Y", strtotime($datanya['data_invoice']->due_date)) ?></td>
                </tr>
                <tr>
                    <td>PO. Number</td>
                    <td>:</td>
                    <td>{{ $datanya['data_invoice']->po_number }}</td>
                </tr>
                <tr>
                <td>TO</td>
                    <td>:</td>
                    <td>{{ $datanya['data_invoice']->nama_customer }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td> 
                        {{ $datanya['data_invoice']->address_customer }}
                        <!-- hanya bisa 60 character -->
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td> 
                        {{ $datanya['data_invoice']->address_customer1 }}
                        <!-- hanya bisa 60 character -->
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td> 
                        {{ $datanya['data_invoice']->deskripsi_customer }}
                        <!-- hanya bisa 60 character -->
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="row">
        <table id="theTable">
            <thead class="bg-info text-white text-center">
                <tr>
                    <th>DESCRIPTION</th>
                    <th>UNIT</th>
                    <th>QUANTITY</th>
                    <th>UNIT PRICE (IDR)</th>
                    <th>LINE TOTAL (IDR)</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach($datanya['data_barang'] as $row)
                <tr>
                    <td>{{ $row->deskripsi}}</td>
                    <td>{{ $row->satuannya}}</td>
                    <td>{{ $row->quantity}}</td>
                    <td>{{ number_format($row->harga_unit, 0, '.', '.') }}</td>
                    <td>{{ number_format($row->total_harga, 0, '.', '.') }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="text-end">Subtotal:</td>
                    <td>IDR {{ number_format($datanya['subtotal'], 0, '.', '.') }}</td>
                </tr>
                @if($datanya['data_invoice']->have_discount == "yes")
                <tr>
                    <td colspan="4" class="text-end">Discount :</td>
                    <td>IDR {{ number_format($datanya['data_invoice']->nominal_discount, 0, '.', '.') }}</td>
                </tr>
                @endif
                <tr>
                    <td colspan="4" class="text-end">{{ $datanya['data_invoice']->proses_category }} {{ $datanya['data_invoice']->proses_percent }}% :</td>
                    <td>IDR {{ number_format($datanya['data_invoice']->subtotal, 0, '.', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-end">PPN 11%:</td>
                    <td>IDR {{ number_format($datanya['data_invoice']->nominal_ppn11, 0, '.', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-end">Total Payment:</td>
                    <td>IDR {{ number_format($datanya['data_invoice']->nominal_pembayaran_with_ppn11, 0, '.', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="width:100px;">
        <b>Regards,</b>
        <img src="{{ base_path().'/public/assets/images/signature.png' }}" alt="tanda tangan" style="widht:50px;height:50px;">
        <b>
            <br>(LUKI GUNADI)
        </b>
    </div>
    
    <br><br>
    <div class="row" style="margin-top:40px;";>
        <div class="col-md-12" style="widht:100%;">
            <img src="{{ base_path().'/public/assets/images/invoices_footer.PNG' }}" alt="header invoices refast indonesia" style="widht:100%;">
        </div>
    </div>

</body>
</html>