<!DOCTYPE html>
<html>
<head>
    <title>Testing PHP Freshers</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>
    <style>
        .table-responsive{
            box-shadow: 0px 0px 5px #999;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">

        <div class="col-sm-12">
            <br />
            <h1>Testing PHP Freshers</h1><br />
            <div class="table-responsive">
                <table id="dataid" class="table table-striped table-bordered" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>URL</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Content</th>
                        <th>Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        include ('index.php');
                        $mysqli = mysqli_connect("localhost", "root", "", "news") or die("Connect fail!");
                        mysqli_query($mysqli,"SET NAMES 'utf8'");

                        $sql = "SELECT * FROM `hotnews` ORDER BY `id` DESC";
                        $query = mysqli_query($mysqli,$sql);
                        while ($row = mysqli_fetch_assoc($query))
                        {
                    ?>
                    <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['url'] ?></td>
                        <td><?php echo $row['title'] ?></td>
                        <td><?php echo $row['description'] ?></td>
                        <td><?php echo $row['content'] ?></td>
                        <td><?php echo $row['created_time'] ?></td>
                    </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script>
    $(document).ready(function() {
        var datatablephp = $('#dataid').DataTable();
    });
</script>