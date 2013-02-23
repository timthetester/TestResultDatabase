			// When the document is loaded perform an ajax query using jquery
			// Callback is used to return the data when the ajax data is ready
			var gHeaders = new Array();;
			$(document).ready(function() {				
				$.ajax({  
					url: "api.php?RetrieveTableFields",  
					cache: false,
					dataType : "json"
					}).done(function( data ) {	
						
						var header="";
						var content="";
						gHeaders.length = 0;
						// Data returned is an array of Table column names and their distinct values
						$.each( data, function(key, value){
							
							$first = 0;
							$.each( value, function(secondKey, field){	
								// The first row is the name of the table
								if ($first == 0)
								{
									// Create a select option box for each table column
									gHeaders.push(field);
									header += "<td>" + field + "</td>";
									content += '<td><select name="' + field + '" id="' + field + '" multiple size="5">';
									//content += '<option value=null>Not selected</option>';
									++$first;
								}
								else
								{
									// Add the selectable fields here
									content += '<option value=\"' + field + '\">' + field + '</option>';
								}
								
							});
							content += '</select></td>';
						});
						
						// Add the select option box to the main page
						$('#menu').append("<table border='0'><tr>" + header + "</tr><tr>" + content + "</tr></table>");
						$('#menu').append('<button>Show results</button>');
						
						$("button").button().on("click", function(){
						var returnObj={};
							for (i=0; i < gHeaders.length ; i++)
							{
								if ($('#' + gHeaders[i]).val())
								{								   
							       returnObj[gHeaders[i]] = $('#' + gHeaders[i]).val();							       
								}
							};
                            return DisplayTable(returnObj)
                         } );							 
									//return DisplaySelectTable("#SummaryID")} );
					});
								
			} );
