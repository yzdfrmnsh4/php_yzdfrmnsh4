
<?php
// STEP 1: Form awal (input baris & kolom)
if (!isset($_POST['step'])) {
?>
<div style="border: 1px solid black; padding: 8px; width: 30%;">

    <form method="post">
        <div>
            <label>Inputkan Jumlah Baris :</label>
            <input type="number" name="baris" required style="margin-bottom: 5px;">
        </div>
        <div>
            <label>Inputkan Jumlah Kolom : </label>
            <input type="number" name="kolom" required>
        </div>
        <input type="hidden" name="step" value="2">
        <button type="submit" style="margin-top: 5px;">SUBMIT</button>   
    </form>
</div>

<?php
// STEP 2: Form input data sesuai baris & kolom
} elseif ($_POST['step'] == 2) {
    $baris = $_POST['baris'];
    $kolom = $_POST['kolom'];
    echo "<div style='border: 1px solid black; padding: 8px; '>";
    echo "<form method='post'>";
    for ($i = 1; $i <= $baris; $i++) {
        for ($j = 1; $j <= $kolom; $j++) {
            echo "$i.$j: <input type='text' name='data[$i][$j]'> ";
        }
        echo "<br>";
    }
    echo "<input type='hidden' name='baris' value='$baris'>";
    echo "<input type='hidden' name='kolom' value='$kolom'>";
    echo "<input type='hidden' name='step' value='3'>";
    echo "<button type='submit' style='margin-top:5px;'>SUBMIT</button>";
    echo "</form>";
    echo "</div>";

// STEP 3: Menampilkan hasil input
} elseif ($_POST['step'] == 3) {
    $data = $_POST['data'];
    foreach ($data as $i => $row) {
        foreach ($row as $j => $value) {
            echo "<b>$i.$j : $value </b> <br>";
        }
    }
}
?>
