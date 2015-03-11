$("#sortable").sortable();
$("#sortable").disableSelection();

countTodos();

// all done btn
$("#checkAll").click(function(){
    AllDone();
});

//create todo
$('.add-todo').on('keypress',function (e) {
      e.preventDefault
      if (e.which == 13) {
           if($(this).val() != ''){
           var todo = $(this).val();
            createTodo(todo); 
            countTodos();
           }else{
               // some validation
           }
      }
});
// mark task as done
$('.todolist').on('change','#sortable li input[type="checkbox"]',function(){
    if($(this).prop('checked')){
        var doneItem = $(this).parent().parent().find('label').text();
        $(this).parent().parent().parent().addClass('remove');
        done(doneItem);
        countTodos();
    }
});

//delete done task from "already done"
$('.todolist').on('click','.remove-item',function(){
    removeItem(this);
});

// count tasks
function countTodos(){
    var count = $("#sortable li").length;
    $('.count-todos').html(count);
}

//create task
function createTodo(text){
    var markup = '<li class="ui-state-default"><div class="checkbox"><label><input type="checkbox" value="" />'+ text +'</label></div></li>';
    $('#sortable').append(markup);
    $('.add-todo').val('');
}

//mark task as done
function done(doneItem){
    var done = doneItem;
    var markup = '<li>'+ done +'<button class="btn btn-default btn-xs pull-right  remove-item"><span class="glyphicon glyphicon-remove"></span></button></li>';
    $('#done-items').append(markup);
    $('.remove').remove();
}

//mark all tasks as done
function AllDone(){
    var myArray = [];

    $('#sortable li').each( function() {
         myArray.push($(this).text());   
    });
    
    // add to done
    for (i = 0; i < myArray.length; i++) {
        $('#done-items').append('<li>' + myArray[i] + '<button class="btn btn-default btn-xs pull-right  remove-item"><span class="glyphicon glyphicon-remove"></span></button></li>');
    }
    
    // myArray
    $('#sortable li').remove();
    countTodos();
}

//remove done task from list
function removeItem(element){
    $(element).parent().remove();
}

// Tables-----------------------------------------------------------------------------------
    $("#add_row").on("click", function() {
        // Dynamic Rows Code
        
        // Get max row id and set new id
        var newid = 0;
        $.each($("#tab_logic tr"), function() {
            if (parseInt($(this).data("id")) > newid) {
                newid = parseInt($(this).data("id"));
            }
        });
        newid++;
        
        var tr = $("<tr></tr>", {
            id: "addr"+newid,
            "data-id": newid
        });
        
        // loop through each td and create new elements with name of newid
        $.each($("#tab_logic tbody tr:nth(0) td"), function() {
            var cur_td = $(this);
            
            var children = cur_td.children();
            
            // add new td and element if it has a nane
            if ($(this).data("name") != undefined) {
                var td = $("<td></td>", {
                    "data-name": $(cur_td).data("name")
                });
                
                var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
                c.attr("name", $(cur_td).data("name") + newid);
                c.appendTo($(td));
                td.appendTo($(tr));
            } else {
                var td = $("<td></td>", {
                    'text': $('#tab_logic tr').length
                }).appendTo($(tr));
            }
        });
        
        // add delete button and td
        /*
        $("<td></td>").append(
            $("<button class='btn btn-danger glyphicon glyphicon-remove row-remove'></button>")
                .click(function() {
                    $(this).closest("tr").remove();
                })
        ).appendTo($(tr));
        */
        
        // add the new row
        $(tr).appendTo($('#tab_logic'));
        
        $(tr).find("td button.row-remove").on("click", function() {
             $(this).closest("tr").remove();
        });
});




    // Sortable Code
    var fixHelperModified = function(e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();
    
        $helper.children().each(function(index) {
            $(this).width($originals.eq(index).width())
        });
        
        return $helper;
    };
  
    $(".table-sortable tbody").sortable({
        helper: fixHelperModified      
    });

    $(".table-sortable thead").disableSelection();



    $("#add_row").trigger("click");
	
	
// Login or signup -----------------------------------------------------------------------------

$(".register").click(function(){
    $( "h3" ).toggle();$( "#loginform , #registerform" ).slideToggle( "slow" );
	return false;
});
$(".login").click(function(){
    $( "h3" ).toggle();$( "#loginform , #registerform" ).slideToggle( "slow" );
	return false;
});

// Check User -----------------------------------------------------------------------------
$("#mybtn").click(function(e) {
	$("div#errorMsg").html('<p class="text-info">Authenticating...</p>');		
	var txtUserName = $("#inputUsernameEmail").val();
	var txtPassword = $("#inputPassword").val();
	if((txtUserName=="" ) || (txtPassword== "")){ 
		$("div#errorMsg").html('<p class="text-danger">Please Enter Username, Password!</p>');
	} else {
		$.get("http://zephyrworks.com/tasker/assets/php/checkUser.php",{ sUname: txtUserName,sPass: txtPassword,rand:Math.random() } ,function(data){
			if(data=='yes'){
				window.location.reload(true);
			}else{
				$("div#errorMsg").html('<p class="text-danger">Sorry, Username was not found!</p>');
			}
		});
		return false;
	}
	e.preventDefault();
});
	
	
// Check social login -----------------------------------------------------------------------------
$("#facebook, #google").click(function(e) {
	$("div#errorMsg").html('<p class="text-info">Authenticating...</p>');		
});

// Create User -----------------------------------------------------------------------------
$("#signupbtn").click(function(e) {
	$("div#errorMsg2").html('<p class="text-info">Processing...</p>');		
	var txtUserName2 = $("#inputUsernameEmail2").val();
	var txtPassword2 = $("#inputPassword2").val();
	var txtPasswordVal = $("#inputPasswordVal").val();
	if((txtUserName2=="" ) || (txtPassword2== "") || (txtPasswordVal== "")){$("div#errorMsg2").html('<p class="text-danger">Please Fill in the form.</p>');return false;e.preventDefault();} 						
	else if (txtPassword2.length < 6 ) {$("div#errorMsg2").html('<p class="text-danger">Minimum of 6 characters</p>');return false;e.preventDefault();}
	else if (txtPassword2 != txtPasswordVal ) {$("div#errorMsg2").html('<p class="text-danger">Password did not match</p>');return false;e.preventDefault();}
	else {	$.post("http://zephyrworks.com/tasker/assets/php/makeUser.php",{ sUname: txtUserName2,sPass: txtPassword2,rand:Math.random() } ,function(data){
		if(data=='yes'){
			window.location.reload(true);
			$("div#errorMsg2").html('<p class="text-success">Activating your account!</p>');
		}
		else if(data=='exists'){
			$("div#errorMsg2").html('<p class="text-danger">User already exists.</p>');
		}
		else{
			$("div#errorMsg2").html('<p class="text-danger">Error, Contact Us</p>');
		}
	});return false;e.preventDefault();}
});