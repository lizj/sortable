<?php
define('_EXECUTE_INCLUDE', true);
?>
<div id="div_listar">
    <h1>Persons</h1>
    <div id="message"></div>
    <a href="#" id="add" class="ui-button" title="Add" onclick="addRow();">
        <span class="ui-icon ui-icon-plusthick">Add</span>
    </a>
    <table id="persons" class="ui-widget ui-widget-content">
        <?php
        include 'manageDB/db_persona.php';

        if (isset($_GET['orderby'])) {
            $orderby = $_GET['orderby'];
        } else {
            $orderby = 'first_name'; //default
        }
        $result = listPerson($orderby);
        if (!(empty($result))) {
            $thead = explode(",", "First Name,Last Name,Country,City,Address,Email");
            $fields = explode(",", "first_name,last_name,country,city,address,email");
            ?>
            <thead>
                <tr class="ui-widget-header ">
                    <?php for ($i = 0; $i < count($thead); $i++) { ?>
                        <th onclick="orderBy('<?php echo $fields[$i] ?>')"><a href="#" ><?php echo $thead[$i] ?></a></th>
                    <?php } ?>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($value = mysqli_fetch_array($result)) {
                    $id = printDate($value['idperson']); ?>
                    <tr>
                        <td id="first_name_<?php echo $id ?>"><?php echo printDate($value['first_name']) ?></td>
                        <td id="last_name_<?php echo $id ?>"><?php echo printDate($value['last_name']) ?></td>
                        <td id="country_<?php echo $id ?>"><?php echo printDate($value['country']) ?></td>
                        <td id="city_<?php echo $id ?>"><?php echo printDate($value['city']) ?></td>
                        <td id="address_<?php echo $id ?>"><?php echo printDate($value['address']) ?></td>
                        <td id="email_<?php echo $id ?>"><?php echo printDate($value['email']) ?></td>
                        <td>
                            <a href="#" id="edit" class="ui-button" title="Edit" onclick="editRow('<?php echo $id ?>');">
                                <span class="ui-icon ui-icon-pencil"></span>
                            </a>
                            <a href="#" id="delete" class="ui-button" title="Delete" onclick="deleteRow('<?php echo $id ?>');">
                                <span class="ui-icon ui-icon-closethick"></span>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        <?php } else { ?>
            <tr><td><span>No records.</span></td></tr>
        <?php } ?>

    </table>

</div>

<div id="confirm-delete" style="display:none;">
    <p>Are you sure?</p>
</div>