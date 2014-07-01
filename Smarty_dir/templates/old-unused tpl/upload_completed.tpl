{if $problem}
    {$problem}
{else}
	<h2>the resource is uploaded succesfully</h2>
	<h3>Summary</h3>
			<table>
                <tr>
                    <td>Name: </td>
                    <td>{$result->getName()}</td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>{$result->getCategory()}</td>
                </tr>
                <tr>
                    <td>Type: </td>
                    <td>{$result->getType()}</td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td>{$result->getUploaderUsername()}</td>
                </tr>
            </table> 
{/if}            