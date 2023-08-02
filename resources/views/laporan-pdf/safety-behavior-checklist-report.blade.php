<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>LAPORAN SAFETY BEHAVIOR</title>
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
        /* @page {
            size: A4;
            margin: 20mm;
        } */

        table {
            width: 100%;
            border-spacing: 0;
            border-collapse: collapse;
            /* Set the border-spacing property to 0 */
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            /* Set fixed widths for the table cells */
            /* width: 120pt; */
            /* width: 20%; */
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
    </style>
</head>

<body>
    <div class="container">
        <div align="center">
            <h2>LAPORAN SAFETY BEHAVIOR CHECKLIST</h2>
        </div>
        <table class="table-center">
            <tr>
                <td colspan="3">
                    Nomor Laporan
                </td>
                <td colspan="6">
                    {{ $nomor_laporan }}
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    Tanggal Temuan
                </td>
                <td colspan="6">
                    {{ $tanggal_temuan }}
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    Pekerjaan
                </td>
                <td colspan="6">
                    {{ $pekerjaan }}
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    Perusahaan
                </td>
                <td colspan="6">
                    {{ $perusahaan }}
                </td>
            </tr>
            <tr height="21">
                <td colspan="9">
                    &nbsp;
                </td>
            </tr>
            <tr>
                <td colspan="9" style="text-align: center">
                    <strong>HASIL ASSESSMENT</strong>
                </td>
            </tr>
            <tr>
                <td>
                    Kategori
                </td>
                <td colspan="5">
                    Perilaku Aman
                </td>
                <td>
                    Safe
                </td>
                <td>
                    Unsafe
                </td>
                <td>
                    N/A
                </td>
            </tr>

            @foreach (json_decode($answer) as $tes)
                @php
                    $counter = 0;
                @endphp
                @foreach ($tes->question_answers as $key => $value)
                    <tr>
                        {{-- @php
                            if ($counter == 0) {
                                echo '<td rowspan="' . count($tes->question_answers) . '">' . $tes->category . '</td>';
                            }
                            $counter = $counter + 1;
                        @endphp --}}
                        <td>{{ $tes->category }}</td>
                        <td colspan="5">
                            <p class="mb-0">{{ $value->question }}</p>
                            <input type="hidden"
                                name="question[{{ $tes->category }}][{{ $value->question_id }}]"
                                value="{{ $value->question }}">
                        </td>
                        <td>
                            <label>
                                <input type="radio"
                                    name="answer[{{ $tes->category }}][{{ $value->question_id }}]"
                                    value="safe"
                                    {{ isset($value->answer) && $value->answer === 'safe' ? 'checked' : '' }}>
                                Safe
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio"
                                    name="answer[{{ $tes->category }}][{{ $value->question_id }}]"
                                    value="unsafe"
                                    {{ isset($value->answer) && $value->answer === 'unsafe' ? 'checked' : '' }}>
                                Unsafe
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio"
                                    name="answer[{{ $tes->category }}][{{ $value->question_id }}]"
                                    value="n/a"
                                    {{ isset($value->answer) && $value->answer === 'n/a' ? 'checked' : '' }}>
                                N/A
                            </label>
                        </td>
                    </tr>
                @endforeach
            @endforeach
            <tr>
                <td colspan="9" style="text-align: center">
                    <strong>Perhitungan Safety Index</strong>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    Safe
                </td>
                <td colspan="3">
                    Unsafe
                </td>
                <td colspan="3">
                    Index
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    no
                </td>
                <td colspan="3">
                    yes
                </td>
                <td colspan="3">
                    no
                </td>
            </tr>
            <tr>
                <td colspan="9">
                    &nbsp;
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    Mengetahui
                </td>
                <td colspan="3">
                    Disetujui Oleh,
                </td>
                <td colspan="3">
                    Dibuat Oleh
                </td>
            </tr>
            <tr height="21">
                <td colspan="3">
                    &nbsp;
                </td>
                <td colspan="3">
                    {{ $approved_by }}
                </td>
                <td colspan="3">
                    {{ $created_by }}
                </td>
            </tr>
            <tr>
                <td colspan="9">
                    TINDAKAN KOREKSI
                </td>
            </tr>
            <tr>
                <td colspan="9">
                    Komentar: {{ $komentar }}
                </td>
            </tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr>
                <td colspan="9">
                    CC:<br />
                    1. Technical and Production Director<br />
                    2. VP Maintenance<br />
                    3. Superintendance MPC<br />
                    4. Supervisor SHE (as file)
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
