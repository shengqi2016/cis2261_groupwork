
$(function(){

    $ ("#reset").on("click", function(){
        window.location = "miniGolfKiosk.html";
    })
 // declare global vars
 let $totalAfterTax = 0.00;

//create function to do the math calculation
 $("#container").on("change",function updateTotals() {
    // get the data and changing to the Jquery

    let $adults = $("#adults").val();


    let $children = $("#children").val();

    // ensure a qty is selected for above
    if ($adults == 0 && $children == 0) {
        // they need to select a qty for children or adults
        alert("You must select a quantity for adults or children.");
    } else {
        // calculate costs

        $("#numAdults").val( $adults);

        let $adultTotal = $adults * 4.00;

       $("#numChildren").val($children);
        let $childTotal = $children * 2.00;

        $("#totalAdultsDiv").html("$" + $adultTotal.toFixed(2));
        $("#totalChildrenDiv").html ("$" + $childTotal.toFixed(2));
        let $totalBeforeTax = ($adultTotal + $childTotal);


        // get discount radio choice
        let $deduct = 0;
        let $discountString = "None";


        if ($( "input[name='discountGroup']:checked" ).val()=="CAA"){
            $deduct = $totalBeforeTax * .10;
            $totalBeforeTax = $totalBeforeTax - $deduct;
            $discountString = "CAA saved $" + $deduct.toFixed(2);

        } else if ($( "input[name='discountGroup']:checked" ).val()== "Military"){
            $deduct = $totalBeforeTax * .25;
            $totalBeforeTax = $totalBeforeTax - $deduct;
            $discountString = "Military saved $" + $deduct.toFixed(2);
        } else if ($( "input[name='discountGroup']:checked" ).val() == "Fun Club Member"){
            $deduct = $totalBeforeTax * .50;
            $totalBeforeTax = $totalBeforeTax - $deduct;
            $discountString = "Super Fun Club saved $" + $deduct.toFixed(2);
        }

        $("#discountString").html($discountString);
        $totalAfterTax = $totalBeforeTax * 1.1;

        $("#totalBeforeTaxDiv").html("$" + $totalBeforeTax.toFixed(2));
        $("#totalAfterTaxDiv").html ("$" + $totalAfterTax.toFixed(2));
    } // end if no adults or children selected


})// end update Totals function

//create function to reset the form
 $("#changeButton").on("click",function() {
     let $amountGiven = parseFloat(prompt("Enter amount client gave you"));

     let $changeDue = $amountGiven-$totalAfterTax;
     $("#changeDue").html("$"+$changeDue.toFixed(2));
     $("#changeOutput").css("display","block");
 })

    //adding show and hide animation to the dateRecord
    $("#showTime").on("click",function(){
        const d= new Date();
        let text =d.toLocaleString();
         $("#showLocalTime").text("For now:"+text);
        $("#showLocalTime").show();
    })

    $("#hideTime").on("click",function(){
        $("#showLocalTime").hide();
    })


})