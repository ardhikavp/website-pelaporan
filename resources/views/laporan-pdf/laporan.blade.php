<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>LAPORAN SAFETY OBSERVATION</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
        }

        .container {
            /* max-width: 100%; commented */
            /* Adjust to accommodate the entire table */
            margin: 0 auto;
        }

        /* Set the page size for PDF printing */
        @page {
            size: A4;
            /* You can adjust to other page sizes like "letter", "legal", etc. */
            margin: 20mm;
            /* Adjust margins as needed */
        }

        table {
            width: 100%;
            border-spacing: 0;
            /* Set the border-spacing property to 0 */
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            /* Set fixed widths for the table cells */
            width: 120pt;
        }

        .center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .table-center {
            margin: 0 auto;
            width: 75%;
        }

        .table-center img {
            display: block;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        <div align="center">
            <h2>LAPORAN SAFETY OBSERVATION</h2>
        </div>
        <table class="table-center">
            <tr>
                <td class="bold" width="160pt">Nomor Laporan</td>
                <td colspan="2">{{ $nomor_laporan }}</td>
            </tr>
            <tr>
                <td class="bold" width="160pt">Tanggal Temuan</td>
                <td colspan="2">{{ $tanggal_temuan }}</td>
            </tr>
            <tr>
                <td class="bold" width="160pt">Lokasi Temuan</td>
                <td colspan="2">{{ $lokasi_temuan }}</td>
            </tr>
            <tr>
                <td class="center" colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td class="center" colspan="3">
                    <h3>HASIL ASSESSMENT</h3>
                </td>
            </tr>
            <tr>
                <td class="bold" width="160pt">Tipe Temuan*</td>
                <td colspan="2">{{ $tipe_temuan }}</td>
            </tr>
            <tr>
                <td class="bold" width="160pt">Gambar Temuan</td>
                <td>
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSj06ORgLc09irkPuj3XplptRIDCv52UUahxCGmCS8Gow&s"
                        alt="">
                </td>
            </tr>
            <tr>
                <td class="bold" width="160pt">Deskripsi Gambar</td>
                <td colspan="2">{{ $deskripsi_gambar }}</td>
            </tr>
            <tr>
                <td class="bold" width="160pt">Potensi Bahaya</td>
                <td colspan="2">{{ $potensi_bahaya }}</td>
            </tr>
            <tr>
                <td class="bold" width="160pt">Dampak</td>
                <td colspan="2">{{ $dampak }}</td>
            </tr>
            <tr>
                <td class="center" colspan="3">
                    <h3>ANALISIS TINDAK LANJUT</h3>
                </td>
            </tr>
            <tr>
                <td class="bold" width="160pt">Jangka Pendek</td>
                <td colspan="2">{{ $jangka_pendek }}</td>
            </tr>
            <tr>
                <td class="bold" width="160pt">Jangka Menengah</td>
                <td colspan="2">{{ $jangka_menengah }}</td>
            </tr>
            <tr>
                <td class="bold" width="160pt">Jangka Panjang</td>
                <td colspan="2">{{ $jangka_panjang }}</td>
            </tr>
            <tr>
                <td class="bold" width="160pt">Mengetahui</td>
                <td class="bold" width="287pt">Direview Oleh</td>
                <td class="bold" width="160pt">Dibuat Oleh</td>
            </tr>
            <tr>
                <td rowspan="3">&nbsp;</td>
                <td rowspan="3">&nbsp;</td>
                <td rowspan="3">&nbsp;</td>
            </tr>
            <tr>
            </tr>
            <tr>
            </tr>
            <tr>
                <td class="bold" width="160pt">Nama</td>
                <td class="bold" width="287pt">Nama</td>
                <td class="bold" width="160pt">Nama</td>
            </tr>
            <tr>
                <td class="bold" width="160pt">Posisi</td>
                <td class="bold" width="287pt">Posisi</td>
                <td class="bold" width="160pt">Posisi</td>
            </tr>
            <tr>
                <td class="center" colspan="3">
                    <h3>TINDAKAN KOREKSI</h3>
                </td>
            </tr>
            <tr>
                <td colspan="3">Komentar: {{ $komentar }}</td>
            </tr>
            <tr>
                <td class="bold" colspan="3">*Unsafe Action/Unsafe Condition/Bad Housekeeping</td>
            </tr>
            <tr>
                <td class="bold" colspan="3">CC:</td>
            </tr>
            <tr>
                <td colspan="2">1. Technical and Production Director</td>
                <td>Tanggal Penyelesaian: {{ $tanggal_penyelesaian }}</td>
            </tr>
            <tr>
                <td colspan="2">2. VP Maintenance</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">3. Superintendance MPC</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">4. Supervisor SHE (as file)</td>
                <td>&nbsp;</td>
            </tr>
        </table>
    </div>
</body>

</html>
