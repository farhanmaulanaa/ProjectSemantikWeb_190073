<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    
    <title>SMAN 22 BANDUNG</title>
  </head>

    <body>
    <?php
        require_once("sparqllib.php");
        $searchInput = "" ;
        $filter = "" ;
        
        if (isset($_POST['search'])) {
            $searchInput = $_POST['search'];
            $data = sparql_get(
            "https://0d15-2001-448a-3020-4668-6ddb-2714-4da0-59ff.ap.ngrok.io/sman22bandung",
            "
            prefix id: <https://sman22bandung.com/> 
            prefix person:  <https://sman22bandung.com/ns/person#> 
            prefix rdf: <https://www.ldf.fi/service/rdf-grapher> 
            SELECT ?nama ?alamat ?kewarganegaraan ?agama ?jeniskelamin ?ttl ?universitas ?jurusan ?tahunmasuk
            WHERE
            { 
                ?persons
                    person:nama                ?nama ;
                    person:alamat              ?alamat ;
                    person:kewarganegaraan     ?kewarganegaraan ;
                    person:agama               ?agama ;
                    person:jeniskelamin        ?jeniskelamin ;
                    person:ttl                 ?ttl ;
                    person:universitas         ?universitas ;
                    person:jurusan             ?jurusan ;
                    person:tahunmasuk          ?tahunmasuk ; .
                    FILTER (   regex (?nama, '$searchInput', 'i')
                    || regex (?universitas, '$searchInput', 'i')
                    || regex (?jurusan, '$searchInput', 'i')
                )
            }"
            );
        } else {
            $data = sparql_get(
                "https://0d15-2001-448a-3020-4668-6ddb-2714-4da0-59ff.ap.ngrok.io/sman22bandung",
                "
                prefix id: <https://sman22bandung.com/> 
                prefix person:  <https://sman22bandung.com/ns/person#> 
                prefix rdf: <https://www.ldf.fi/service/rdf-grapher> 
                SELECT ?nama ?alamat ?kewarganegaraan ?agama ?jeniskelamin ?ttl ?universitas ?jurusan ?tahunmasuk
                WHERE
                { 
                    ?persons
                        person:nama                ?nama ;
                        person:alamat              ?alamat ;
                        person:kewarganegaraan     ?kewarganegaraan ;
                        person:agama               ?agama ;
                        person:jeniskelamin        ?jeniskelamin ;
                        person:ttl                 ?ttl ;
                        person:universitas         ?universitas ;
                        person:jurusan             ?jurusan ;
                        person:tahunmasuk          ?tahunmasuk ; .
                }"
            );
        }

        if (!isset($data)) {
            print "<p>Error: " . sparql_errno() . ": " . sparql_error() . "</p>";
        }
    ?>
            <div id="section1">
                <div class="col-sm-12">
                    <div class="searchbox">
                        <form role="search" action="" method="post" id="search" name="search">
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-outline1">
                                    <i class="bi bi-search fs-5"></i>
                                    <input type="search" id="#" name="search" class="form-control1" placeholder="Search" aria-label="Search"/>
                                </div>
                            </div>
                            <div class="col-sm">
                                <a href="#"><button class="btn btn-1">Search</button></a>
                            </div>
                            </div>
                        </form>
                    </div>
                    <p>List Student</p>
                <table class="table">
                    <thead class="table-header">
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Kewarganegaraan</th>
                            <th scope="col">Agama</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">TTL</th>
                            <th scope="col">universitas</th>
                            <th scope="col">Jurusan</th>
                            <th scope="col">Tahun Masuk</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        <?php $i = 0; ?>
                        <?php foreach ($data as $data) : ?>
                            <tr>
                                <td><?= $data['nama'] ?></td>
                                <td><?= $data['alamat'] ?></td>
                                <td><?= $data['kewarganegaraan'] ?></td>
                                <td><?= $data['agama'] ?></td>
                                <td><?= $data['jeniskelamin'] ?></td>
                                <td><?= $data['ttl'] ?></td>
                                <td><?= $data['universitas'] ?></td>
                                <td><?= $data['jurusan'] ?></td>
                                <td><?= $data['tahunmasuk'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                </div>
                <br><br>
            </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>