<script type="text/template" data-grid="address" data-template="results">

	<% _.each(results, function(r) { %>

		<tr data-grid-row>
			<td><input content="id" input data-grid-checkbox="" name="entries[]" type="checkbox" value="<%= r.id %>"></td>
			<td><a href="<%= r.edit_uri %>" href="<%= r.edit_uri %>"><%= r.id %></a></td>
			<td><%= r.label %></td>
			<td><%= r.name %></td>
			<td><%= r.address_line_1 %></td>
			<td><%= r.address_line_2 %></td>
			<td><%= r.address_line_3 %></td>
			<td><%= r.postcode %></td>
			<td><%= r.country %></td>
			<td><%= r.city %></td>
			<td><%= r.street %></td>
			<td><%= r.street_number %></td>
			<td><%= r.ic %></td>
			<td><%= r.dic %></td>
			<td><%= r.type %></td>
			<td><%= r.created_at %></td>
		</tr>

	<% }); %>

</script>
