<div id="registrationForm">
        <form name="formRegister" method="POST" enctype="multipart/form-data" action="index.php?controllerAction=registration">
            <table>
                <tr>
                    <td>Name: </td>
                    <td><input name="nameUser" type="text"/></td>
                </tr>
                <tr>
                    <td>Surname: </td>
                    <td><input name="surname" type="text"/></td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td><input name="email" type="text"/></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input name="username" type="text"/></td>
                    {if $error==TRUE}
                    <td>The username was already taken</td>
                    {/if}
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input name="password" type="text"/></td>
                </tr>
                <tr>
                    <td>Degree Course:</td>
                    <td>
                        <select name="courseDegree">
                            {foreach $degreeCourses as $opt}
                                <option value="{$opt->getName()}">{$opt->getName()}</option>
                            {/foreach}
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><button type="submit" class="button">Sign In</button> </td>
                </tr>
            </table>
        </form>
    </div>
