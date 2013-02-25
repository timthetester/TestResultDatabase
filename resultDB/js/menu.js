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
									header += '<td>' + field + "</td>";
									content += '<td><select class="ui-widget-content" name="' + field + '" id="' + field + '" multiple size="5">';
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
						$('#menu').append('<table border="0"><tr class="ui-widget-content">' + header + '</tr><tr class="ui-widget-content">' + content + "</tr></table>");
						$('#menu').append('<button id="buttonres">Show results</button>');
						$('#menu').append('<button id="buttontrend">Show trend results</button>');
						
						$("#buttonres").button().on("click", function(){
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
						
						$("#buttontrend").button().on("click", function(){
							var returnObj={};
								for (i=0; i < gHeaders.length ; i++)
								{
									if ($('#' + gHeaders[i]).val())
									{								   
								       returnObj[gHeaders[i]] = $('#' + gHeaders[i]).val();							       
									}
								};
	                            return DisplaySelectTable(returnObj)
	                         } );							 
									//return DisplaySelectTable("#SummaryID")} );
					});
								
			} );
