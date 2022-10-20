// bebas
<form action="/pdf" method="get">
    @csrf
    <input type="integer" name="year" placeholder="year">
    <input type="integer" name="month" placeholder="bulan">
    <input type="submit" value="get pdf">
</form>

dr tanggal sampai tanggal tertentu
<form action="/pdf" method="get">
    @csrf
    <input type="date" name="awal" placeholder="year">
    <input type="date" name="akhir" placeholder="bulan">
    <input type="submit" value="get pdf">
</form>



<form action="/excel" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file">
    <input type="submit" value="excel">
</form>