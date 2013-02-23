			// When the document is loaded perform an ajax query using jquery
			// Callback is used to return the data when the ajax data is ready
			var oSelectDataTable = "";
			function DisplaySelectTable(Label) {	
				$.ajax({  
					url: "api.php?sortedTableData",  
					cache: false,
					dataType : "json"
					}).done(function( data ) {						
								
						if (oSelectDataTable) 
						{							
							oSelectDataTable.fnReloadAjax( 'api.php?tableData' ); 
						}
						else
						{
							// Using jquery iterate through each of the labels returned from the ajax query
							// and add them to the table on the main page
							$.each( data.labels, function(i, n){						    
							    $('#headers').append('<th>' + n + '</th>');
							});
							
							// Pass the table data to datatable (jquery plugin) for further processing
							oSelectDataTable = $('#example').dataTable( 
									{
									"bProcessing": true,
									"bJQueryUI": true,
									"sPaginationType": "full_numbers",
									"bPaginate": false,
									"iDisplayLength": 50,
									"aaData": data.aaData 
									});							
						}
					});
								
			};
