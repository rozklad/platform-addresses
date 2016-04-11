<script type="text/template" data-grid="countries" data-template="results">

	<% _.each(results, function(r) { %>

		<tr data-grid-row>
			<td><input content="id" input data-grid-checkbox="" name="entries[]" type="checkbox" value="<%= r.id %>"></td>
			<td><a href="<%= r.edit_uri %>" href="<%= r.edit_uri %>"><%= r.id %></a></td>
			<td><%= r.name_simple %></td>
			<td><%= r.cca2 %></td>
			<td><%= r.ccn3 %></td>
			<td><%= r.cca3 %></td>
			<td><%= r.cioc %></td>
			<td><%= r.capital %></td>
			<td><%= r.region %></td>
			<td><%= r.subregion %></td>
			<td><%= r.demonym %></td>
			<td><%= r.landlocked %></td>
			<td><%= r.area %></td>
			<td><%= r.code %></td>
			<td><%= r.delivering %></td>
		</tr>

	<% }); %>

</script>
