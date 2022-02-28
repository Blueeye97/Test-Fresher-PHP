<?php
include('simple_html_dom.php');
$mysqli = mysqli_connect("localhost", "root", "", "news") or die("Connect fail!");
$url = 'https://bongda365.top/bong-da-viet-nam';
$html = file_get_html($url);
$arr = [];
foreach(array_unique($html->find('.col-5.col-md-4.pr-3.pr-md-0 a')) as $element) {
    $arr[] = $element->href;
}

$arr = array_unique($arr);
foreach ($arr as $item) {

   $html5 = file_get_html($item);

    $title = $html5->find('h1.font-22.font-md-30',0);
    $title_c = '';
    if (!empty($title->plaintext)) {
        $title_c = $title->plaintext;
    }
    $title_c = addslashes( $title_c );

    $description = $html5->find('h2.description',0);
    $description_c = '';
    if (!empty($description->plaintext)) {
        $description_c = $description->plaintext;
    }
    $description_c = addslashes( $description_c );

    $content = $html5->find('#table-of-content',0);
    $content_c = '';
    if (!empty($content->plaintext)) {
        $content_c = $content->plaintext;
    }
    $content_c = addslashes( $content_c);

    $created_time = $html5->find('.d-flex.text-gray10.mb-2.flex-wrap div',0)->plaintext;
    $timestamp = preg_replace("/[^0-9]/", "", "$created_time" );
    $date = DateTime::createFromFormat('dmYHi', $timestamp);
    $new_date_format = $date->format('Y-m-d H:i:s');

    $sql = "INSERT INTO hotnews (url,title,description,content,created_time)
        VALUES ('$item', '$title_c', '$description_c', '$content_c', '$new_date_format')";

    if ($mysqli->query($sql) === TRUE) {
        echo "*";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

}


