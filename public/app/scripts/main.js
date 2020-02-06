// Append to select (From) all users on load
$(document).ready(loadListUsersSendingMoney);

// POST moneyTransfert
$("#transfertMoneyBtn").click(function(e) {
    e.preventDefault();
    let userFromBalanceAmount = $('#userFromBalance').html();
    let userFrom = $('#userFrom')[0].value;
    let userTo = $('#userTo')[0].value;
    let amount = $('#amount')[0].value;

    let data = {
        from_account_balance: parseInt(userFromBalanceAmount),
        from_amount: parseInt(amount),
        from_account: parseInt(userFrom),
        from_currency: 'SEK',
        to_amount: parseInt(amount),
        to_account: parseInt(userTo),
        to_currency: 'SEK',
        currency_rate: 1
    };

    let json = JSON.stringify(data);

    $.ajax({
        type: "POST",
        url: "http://bank.local/api/transactions/create.php",
        data: json,
        success: function(data) {
            $('#messageDisplay').html('<div class="alert alert-success">Transfer successfull</div>');
            reloadTransfertInfo(userFrom);
        },
        error: function(j, error, errorthrown) {
            if (`${j.responseText}:contains(SQLSTATE[HY000])`) {
                j.responseText = "All fields required";
            }
            $('#messageDisplay').html(`<div class="alert alert-danger">${j.responseText}</div>`);
        }
    });
});

// Select Event listener on user sending money
$('#userFrom').change(function(e) {
    let userFromAccountId = $('#userFrom')[0].value;
    let userTo = $('#userTo')[0].value;
    $('#divTable').html('');
    $('#divTable').append('<h1>Your last transactions</h1>');
    // Append to select (To) all users
    $('#userTo').html('');

    loadListUsersReceivingMoney(userFromAccountId);

    // Get balances
      /* balanceUsersendingMoney(userFromAccountId);
      balanceUsersReceivingMoney(userTo); */
      reloadTransfertInfo(userFromAccountId);
});

// Select Event listener on user receiving money
$('#userTo').change(function(e) {
    let userTo = $('#userTo')[0].value;
    /* balanceUsersReceivingMoney(userTo); */
});


function reloadTransfertInfo(userFromAccountId) {
    // Get history of transaction for user sending money
    $.ajax({
        url:`http://bank.local/api/transactions/read_single_user_from.php?id=${userFromAccountId}`,
        success: function(data) {
            // Create table
            let table = $('#transactionTable');
            table.html('');
            let thead = "<thead><th>ID</th><th>Amount</th><th>Currency</th><th>To Account</th><th>Date</th>";
            table.append(thead);
            table.append('<tbody>');

            let transactionsList = data.data;
            for (transaction of transactionsList) {
            let row = `<tr><td>${transaction.transaction_id}</td><td>${transaction.from_amount}</td><td>${transaction.from_currency}</td><td>${transaction.to_account}</td><td>${transaction.date}</td>`;
            table.append(row);
            }
            table.append('</tbody>');
        }
      });
}

function balanceUsersendingMoney(userFromAccountId) {
    let userFromBalance = $('#userFromBalance');
    $.ajax({
        url: `http://bank.local/api/balance/read_single.php?id=${userFromAccountId}`,
        success: function(data) {
        let userBalance = data.balance;
        userFromBalance.html('Balance: ' + userBalance);
        }
      });
}

function balanceUsersReceivingMoney(userTo) {
    let userToBalance = $('#userToBalance');
    // Get balance for user receiving money
    $.ajax({
        url: `http://bank.local/api/balance/read_single.php?id=${userTo}`,
        success: function(data) {
        let userBalance = data.balance;
        userToBalance.html('Balance: ' + userBalance);
        }
      });
}

function loadListUsersSendingMoney() {
    $.ajax({
        url: 'http://bank.local/api/usersInfoMoneyTransfer/read.php',
        success: function(data) {
  
          let userList = data.data;
  
          for (user of userList) {
              let row = `<option value="${user.account_id}">${user.account_id} - ${user.firstName} ${user.lastName} ${user.mobilephone}</option>`;
              $('#userFrom').append(row);
          }
        }
      });
}

function loadListUsersReceivingMoney(userFromAccountId) {
    $.ajax({
        url: 'http://bank.local/api/usersInfoMoneyTransfer/read.php',
        success: function(data) {
  
          let userList = data.data;
  
          for (user of userList) {
              let row = `<option value="${user.account_id}">${user.account_id} - ${user.firstName} ${user.lastName} ${user.mobilephone}</option>`;
              $('#userTo').append(row);
          }

        // Take away the user selected from the receiving user list
        $(`#userTo option[value="${userFromAccountId}"]`).remove();
        }
      });
}
