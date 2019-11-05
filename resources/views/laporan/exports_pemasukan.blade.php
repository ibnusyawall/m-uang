<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<table id="data_p" class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Nominal</th>
                    <th scope="col">Sumber</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($pemasukan as $index=>$p)
                  <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ date('d M Y ', strtotime($p->tanggal)) }}</td>
                    <td>Rp. {{ number_format( $p->nominal, 0) }}</td>
                    <td>{{ $p->nama }}</td>
                  </tr>
                @endforeach
                <tr>
                	<td></td>
                	<td>Total Pemasukan : </td>
                	<td>Rp. <b>{{ number_format($t_pemasukan, 0) }}</b></td>
                </tr>
                </tbody>
              </table>
</body>
</html>