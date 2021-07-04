<?php include "includes/header.php";
?>

<select class="selectpicker" multiple data-actions-box="true">
    <option>Mustard</option>
    <option>Ketchup</option>
    <option>Relish</option>
</select>

<form action="" method="post">
    <select name="type">
        <option value="income">income</option>
        <option value="expense">expense</option>
    </select>
    <select name="category">
        <option value="salary">Salary</option>
        <option value="inc">Income</option>
        <option value="food">Food</option>
        <option value="transport">Transport</option>
        <option value="mobile">Mobile</option>
        <option value="internet">Internet</option>
        <option value="fun">Fun</option>
        <option value="other">Other</option>

    </select>
    <input style="margin-right: 10px" type="number" name="amount" required>
    <input type="text" name="comment">
    <input class="btn btn-primary" type="submit" value="Submit" name="submit">
</form>