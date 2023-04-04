document.querySelectorAll(".valid").forEach(element => {
    element.addEventListener("click", function(){
        console.log("readDayScript.js eventListener detected!");
        console.log("Selected date: " + element.id);
        $.ajax({
            type:     "POST",
            url:      "readDay.php",
            dataType: "JSON",
            data:     "date=" + element.id,
            success: function(array){
                /* TEST: */
                // console.log(array);
            },
            error: function(error){
                // console.log (error.responseText);
            }
        });
    });
});