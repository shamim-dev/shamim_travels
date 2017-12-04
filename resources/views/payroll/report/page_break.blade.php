<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		table, th, td { border: 1px solid gray; border-collapse: collapse; }
th, td { padding: 8px; }
tbody:first-of-type { background-color: #eee; }

/*@page {
    size: A4;
    margin: 0;
}
*/
@media print {
    html, body {
        width: 210mm;
        height: 297mm;
    }
    tbody::after {
        content: ''; display: block;
        page-break-after: always;
        page-break-inside: avoid;
        page-break-before: avoid;        
    }
    
  
}
	</style>
</head>
<body>

<table>
    <thead>
		<tr>
			<th>Head 1</th>
			<th>Head 2</th>
			<th>Head 3</th>
		</tr>
    </thead>
	<tbody>
		<tr>
			<td>Row 1 Cell 1</td>
			<td>Row 1 Cell 2</td>
			<td>Row 1 Cell 3</td>
		</tr>
		<tr>
			<td>Row 2 Cell 1</td>
			<td>Row 2 Cell 2</td>
			<td>Row 2 Cell 3</td>
		</tr>
	</tbody>
	<tbody>
		<tr>
			<td>Row 3 Cell 1</td>
			<td>Row 3 Cell 2</td>
			<td>Row 3 Cell 3</td>
		</tr>
		<tr>
			<td>Row 4 Cell 1</td>
			<td>Row 4 Cell 2</td>
			<td>Row 4 Cell 3</td>
		</tr>
	</tbody>
    <tfoot>
		<tr>
			<th>Foot 1</th>
			<th>Foot 2</th>
			<th>Foot 3</th>
		</tr>	
    </tfoot>
</table>

</body>
</html>