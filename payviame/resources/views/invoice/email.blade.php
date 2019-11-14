<div>
@php
$array = explode("\n", $data['bodyMessage']);
foreach($array as $key => $value) {
    echo '<span>' . $value .'</span><br>';
}
@endphp
</div>