<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Magang - PDF</title>
</head>

<body style="font-family: Arial, sans-serif; margin: 20px;">

    <h2 style="text-align: center;">DATA MAGANG KOMINFO KABUPATEN MALANG</h2>

    <table style="width: 100%; border-collapse: collapse; margin-top: 20px; border-color: yellow;">
        <thead>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px; background-color: #DC143C; color: white;">ID</th>
                <th style="border: 1px solid #ddd; padding: 8px; background-color: #DC143C; color: white;">Nama</th>
                <th style="border: 1px solid #ddd; padding: 8px; background-color: #DC143C; color: white;">Bidang</th>
                <th style="border: 1px solid #ddd; padding: 8px; background-color: #DC143C; color: white;">Tanggal Mulai</th>
                <th style="border: 1px solid #ddd; padding: 8px; background-color: #DC143C; color: white;">Tanggal Selesai</th>
                <th style="border: 1px solid #ddd; padding: 8px; background-color: #DC143C; color: white;">Status Pengajuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengajuan as $p)
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ $p->id }}</td>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ $p->user->nama }}</td>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ $p->databidang->nama }}</td>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ $p->tanggalmulai }}</td>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ $p->tanggalselesai }}</td>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ $p->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>