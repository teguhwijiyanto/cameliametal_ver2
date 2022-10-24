<!DOCTYPE html>
<html lang="en">
    <style>
        body{
            margin: 0px;
            padding: 0px;
        }
        table, th, td {
          border:1px;
          padding-left: 20px;
          margin-top: 4px;
          margin-bottom: 4px;
        }   

        h2{
            margin-top : 15px;
            margin-bottom: 5px;
            text-align: left;
            padding-left: 60px;
        }

        .small-text {
            font-size: 14px;
            color: black;
            margin: 0px;
        }

        .medium-text {
            font-size: 14px;
            color: black;
            margin: 5px;
            margin-bottom: 5px;
        }

        .address{
            font-size: 14px;
            color: black;
            margin: 1px;
            margin-left: 5px;
        }
    </style>
    <body>
        @foreach ($smeltings as $smelting)
            <h2>{{ $title }}</h2>
                <p class="medium-text">A Subsidiary of Camellia Metal Co. Ltd</p>
                <p class="address">JL. RAMIN 1 BLOK G6 No.9 DELTASILOCON VII LIPPO CIKARANG</p>
                <p class="address">DESA JAYA MUKTI, CIKARANG PUSAT, BEKASI 17550</p>    
                <table>
                    <tr>
                        <td>Grade</td>
                        <td>: {{$data->bb_grade}}</td>
                    </tr>
                    <tr>
                        <td>Size (mm)</td>
                        <td>: {{$data->fg_size_1}}</td>
                    </tr>
                    <tr>
                        <td>Tolerance (mm)</td>
                        <td>: {{$data->tolerance_minus}}</td>
                    </tr>
                    <tr>
                        <td>Length (mm)</td>
                        <td>: {{$data->fg_size_2}}</td>
                    </tr>
                    <tr>
                        <td>Bundle</td>
                        <td>: {{$smelting->bundle_num}}</td>
                    </tr>
                    <tr>
                        <td>N. WT</td>
                        <td>: </td>
                    </tr>
                    <tr>
                        <td>Prod. Date</td>
                        <td>: </td>
                    </tr>
                    <tr>
                        <td>Job No.</td>
                        <td>: {{$data->wo_number}}</td>
                    </tr>
                    <tr>
                        <td>Mesin</td>
                        <td>: {{$data->machine->name}}</td>
                    </tr>
                </table>
                <p class="small-text">Made in Indonesia</p>
        @endforeach  
    </body> 
</html>

    