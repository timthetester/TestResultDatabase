			// When the document is loaded perform an ajax query using jquery.
			// Callback is used to return the data when the ajax data is ready.
            var oDataTable = "";
			function DisplayTable(Label) {				
				$.ajax({  
					url: "api.php?headers",  
					cache: false,
					dataType : "json"
					}).done(function( data ) {	
						
						// Pass filter through to api
						var filter="";
						$.each( Label, function(key, value){
							filter += "&filter[" + key + "]=" + value;
						});
						
						// If datatable has already been created then only update it
						if (oDataTable) 
						{	
							//alert('api.php?tableData' + filter);
							oDataTable.fnReloadAjax( 'api.php?tableData' + filter); 
						}
						else
						{
							// Iterate through all of the header data and add it to the table on the main page
							for (i=0; i < data.aaData.length; i++)
							{												
							   $('#headers').append('<th>' + data.aaData[i] + '</th>');
							}		

						//alert('api.php?tableData' + filter);
							// Using the jquery plugin (datatables) perfrom an ajax query of the table data
							oDataTable = $('#example').dataTable( {								
								"bProcessing": true,
								"bJQueryUI": true,
								"sPaginationType": "full_numbers",
								"bPaginate": false,
								"iDisplayLength": 50,
								"sAjaxSource": 'api.php?tableData' + filter							
							} );
						}
						
					});
								
			};
