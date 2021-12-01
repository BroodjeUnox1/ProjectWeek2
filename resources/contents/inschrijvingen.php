<?php 
// include all needed informatio
include("./api/database/db.php");
include("database.php");

$db = new Database;
$sql = "SELECT * FROM inschrijvingen";
$result = $conn->query($sql);
$username = $_SESSION['username'] ?? NULL;
$admin = $_SESSION['admin'] ?? NULL;

$db->prepare("SELECT id, bsn, email, naam, datum, tel, madeby, approved FROM inschrijvingen");
$db->bind("madeby", $username);
$response = $db->fetchAll();
?>

<!-- loop over all signups -->
<?php foreach($response as $entry): ?>

<!-- set background and approved -->
<?php switch($entry['approved']) {
    case "0":
        $bg = "bg-warning";
        $entry['approved'] = "nog niet";
    break;
    case "1":
        $bg = "bg-success";
        $entry['approved'] = "ja";
    break;
    case "2":
        $bg = "bg-danger";
        $entry['approved'] = "nee";
    break;
}?>
<!-- if user is admin -->
<?php if($admin == 1): ?>
<div class='card <?=$bg?> mx-auto'>
<div class='card-body'>
    <h5 class='card-title'>
    <div class="row ml-2">
        <div class="col-md-12">
        <?=$entry['naam']?>
        <input value='Edit' onclick='editadmin(this)' data-id='<?=$entry["id"]?>' data-bsn='<?=$entry["bsn"]?>' data-email='<?=$entry["email"]?>' data-datum='<?=$entry["datum"]?>' data-tel='<?=$entry["tel"]?>' data-madeby='<?=$entry["madeby"]?>' data-approved='<?=$entry["approved"]?>' class='btn btn-info formInput float-right mb-2'>
        <input value='Delete' onclick='deleteSignup(<?=$entry["id"]?>)' class='btn btn-danger formInput float-right mb-2 mr-2'></div>
    </div>
    </h5>
    <div class='row'>
        <div class='col-2 col-md-2 mt-2 mb-2'>
            <label>bsn:</label>
            <p class='card-text'><?=$entry['bsn']?></p>
        </div>
        <div class='col-2 col-md-2 mt-2 mb-2'>
            <label>email:</label> 
            <p class='card-text'><?=$entry['email']?></p>
        </div>
        <div class='col-2 col-md-2 mt-2 mb-2'>
            <label>geboortedatum:</label> 
            <p class='card-text'><?=$entry['datum']?></p>
        </div>
        <div class='col-2 col-md-2 mt-2 mb-2'>
            <label>telefoon nummer:</label> 
            <p class='card-text'><?=$entry['tel']?></p>
        </div>
        <div class='col-2 col-md-2 mt-2 mb-2'>
            <label>gemaakt door:</label> 
            <p class='card-text'><?=$entry['madeby']?></p>
        </div>
        <div class='col-2 col-md-2 mt-2 mb-2'>
            <label>goedgekeurd:</label> 
            <p class='card-text'><?=$entry['approved']?></p>
        </div>
            
    </div>
    </div>
</div>
<!-- check for own signup so you can edit them -->
<?php elseif ($entry['madeby'] == $username) :?>
    <div class='card <?=$bg?> mx-auto'>
<div class='card-body'>
    <h5 class='card-title'>
    <div class="row ml-2">
        <div class="col-md-12">
        <?=$entry['naam']?>
        <input value='Edit' onclick='edit(this)' data-id='<?=$entry["id"]?>' data-bsn='<?=$entry["bsn"]?>' data-email='<?=$entry["email"]?>' data-datum='<?=$entry["datum"]?>' data-tel='<?=$entry["tel"]?>' class='btn btn-info formInput float-right mb-2'>
        <input value='Delete' onclick='deleteSignup(<?=$entry["id"]?>)' class='btn btn-danger formInput float-right mb-2 mr-2'></div>
    </div>
    </h5>
    <div class='row'>
        <div class='col-2 col-md-2 mt-2 mb-2'>
            <label>bsn:</label>
            <p class='card-text'><?=$entry['bsn']?></p>
        </div>
        <div class='col-2 col-md-2 mt-2 mb-2'>
            <label>email:</label> 
            <p class='card-text'><?=$entry['email']?></p>
        </div>
        <div class='col-2 col-md-2 mt-2 mb-2'>
            <label>geboortedatum:</label> 
            <p class='card-text'><?=$entry['datum']?></p>
        </div>
        <div class='col-2 col-md-2 mt-2 mb-2'>
            <label>telefoon nummer:</label> 
            <p class='card-text'><?=$entry['tel']?></p>
        </div>
        <div class='col-2 col-md-2 mt-2 mb-2'>
            <label>gemaakt door:</label> 
            <p class='card-text'><?=$entry['madeby']?></p>
        </div>            
    </div>
    </div>
</div>
<!-- else you cant edit them -->
<?php else: ?>
        <div class='card <?=$bg?> mx-auto'>
<div class='card-body'>
    <h5 class='card-title'>
    <div class="row ml-2">
        <?=$entry['naam']?>
    </div>
    </h5>
    <div class='row'>
          <div class='col-2 col-md-2 mt-2 mb-2'>
            <label>gemaakt door:</label> 
            <p class='card-text'><?=$entry['madeby']?></p>
        </div>
        <div class='col-2 col-md-2 mt-2 mb-2'>
            <label>goedgekeurd:</label> 
            <p class='card-text'><?=$entry['approved']?></p>
        </div>
    </div>
    </div>
</div>
<?php endif; ?>
<?php endforeach; ?>


<script type="text/javascript">

    function edit(el){
        console.log(el)
        // only get the dataset
        var data = el.dataset;

        // loop over
        Object.keys(data).forEach(function (key) {
            let value = data[key];
            console.log(`${key} - ${value}`)

            // set new modal values
            $(`#edit_${key}_user`).val(value)

        });
        // open modal when done
        $('#edit_modaluser').modal('toggle')
    }

    function editadmin(el){
        console.log(el)
        var data = el.dataset;

        Object.keys(data).forEach(function (key) {
            let value = data[key];
            console.log(`${key} - ${value}`)

            $(`#edit_${key}`).val(value)

        });

        $('#edit_modal').modal('toggle')
    }


    function toggle(){
        $('#edit_modal').modal('toggle')
    }

    function toggle2(){
        $('#edit_modaluser').modal('toggle')
    }


    function update() {
        // get modal values
        var bsn = $('#edit_bsn').val()        
        var email = $('#edit_email').val()
        var datum = $('#edit_datum').val()
        var tel = $('#edit_tel').val()
        var madeby = $('#edit_madeby').val()
        var approved = $('#edit_approved').val()
        var id = $('#edit_id').val()
        // make ajax post
        $.post('./api/update/update.php', {bsn: bsn, email: email, datum: datum, tel: tel, madeby: madeby, approved: approved, id: id}, function(response){
            console.log(response)
            // if respone reload
            if(response != 'mooi'){
                location.reload();
            }
        })
    }

    function updateuser() {

        var bsn = $('#edit_bsn_user').val()        
        var email = $('#edit_email_user').val()
        var datum = $('#edit_datum_user').val()
        var tel = $('#edit_tel_user').val()
        var id = $('#edit_id_user').val()

        $.post('./api/update/update2.php', {bsn: bsn, email: email, datum: datum, tel: tel, id: id}, function(response){
            console.log(response)

            if(response != 'mooi'){
                location.reload();
            }
        })
    }

    function deleteSignup(val) {
        // make ajax post
        $.post('./api/delete/delete.php', {id: val}, function(response){
            console.log(response)
            // if respone reload
            if(response == 'mooi'){
                location.reload();
            }
        })
    }
</script>