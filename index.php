<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Witch VS Coder</title>
</head>
<style>
    * {
        box-sizing: border-box; 
    }
    .section {
        display: flex;
        width: 100%;
        justify-content: center;
    }
    .myForm {
        display: flex;
        background-color: beige;
        border-radius: 3px;
        padding: 1.8em;
        width: 50%;
        flex-direction: column;
    }

    .person {
        flex: 1; 
        margin-right: 2em;
    }
    .person input {
        width: 100%;
    }
    .person input {
        padding: 1em;
        margin-bottom: 1em;
    }

    .submit-button {
        padding: 1em;
    }
</style>
<body>
    <form class="myForm" method="post" action="process/execute.php" name="person-calculate">
        <div class="section">
            <div class="person">
                <h3>Person A</h3>
                <label for="name">Age of Death</label>
                <input type="number" name="personA[aod]" min="0">
    
                <label for="townborn">Year of Death</label>
                <input type="number" name="personA[yod]" min="0">
            </div>
            <div class="person">
                <h3>Person B</h3>
                <label for="name">Age of Death</label>
                <input type="number" name="personB[aod]" min="0">
    
                <label for="townborn">Year of Death</label>
                <input type="number" name="personB[yod]" min="0">
            </div>
        </div>
        <button class="submit-button" type="submit">Calculate!</button>
    </form>
</body>
</html>