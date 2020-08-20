
    function myFunction(val) {
        

        var container = document.getElementById("div_termin");
            // Clear previous contents of the container
            while (container.hasChildNodes()) {
                container.removeChild(container.lastChild);
            }


        for(i=1; i<=val;i++){
            var input = document.createElement("input");
                input.type = "text";
                input.name = "termin" + i;
                container.appendChild(input);
                // Append a line break 
                container.appendChild(document.createElement("br"));
        }
      
    }

