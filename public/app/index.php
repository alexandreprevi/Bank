<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <title>Document</title>
</head>

<body>

  <div class="container">
    <div class="row">
    
      <div class="col-sm">
      <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2" id="messageDisplay">
        </div>
    </div>
        <h1>Transfer Money</h1>
        <form class="form-horizontal" action="" method="POST">

          <div class="form-group col-sm-10">
            <label class="control-label col-sm-2" for="userFrom">From:</label>
            <select class="form-control" id="userFrom" required>
              <option value="null">Select User</option>
            </select>
          </div>

          <!-- <div class="col-sm-10">
            <p id="userFromBalance"></p>
          </div> -->

          <div class="form-group col-sm-10">
            <label class="control-label col-sm-2" for="userTo">To:</label>
            <select class="form-control" id="userTo" required>
              <option value="null">Select User</option>
            </select>
          </div>

          <!-- <div class="col-sm-10">
            <p id="userToBalance"></p>
          </div> -->

          <div class="form-group col-sm-10">
            <label class="control-label col-sm-2" for="amount">Amount:</label>
            <input class="form-control" type="number" id="amount" min="1" required />
          </div>

          <div class="form-group col-sm-offset-2 col-sm-1">
            <button type="submit" id="transfertMoneyBtn" class="btn btn-primary">Send</button>
          </div>
        </form>
      </div>
      <div class="col-sm">
      <div id="divTable"></div>
        <table id="transactionTable" class="table table-striped"></table>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="scripts/main.js"></script>
</body>

</html>