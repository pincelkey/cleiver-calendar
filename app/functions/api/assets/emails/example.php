<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background: #EFE8F7; padding: 3rem 0; font-family: Sans-Serif">
    <tr>
    <td width="100%" align="center" style="padding: 0 1rem">
        <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td width="600" align="center">
            <div style="background: #6600EC; color: white; width: 100%; max-width: 640px;">
                <header style="background: white; padding: 1rem;">
                    <img src="<?= get_template_directory_uri() ?>/static/images/jm-logo.png" style="width: 100px;">
                </header>

                <div style="padding: 1rem;">
                    <h1 style="font-size: 25px; color: white;">Titulo del mensaje</h1>

                    <table style="width: 100%; padding-left: 1.5rem">          
                        <tbody style="width: 100%">
                            <tr>
                                <td style="padding: 10px 0; width: 30%; font-weight: bold; color: white; font-weight:bold">Campo: </td>
                                <td style="padding: 10px 0; color: white;"><?= $data['field'] ?></td>     
                            </tr>
                            <tr>
                                <td style="padding: 10px 0; width: 30%; font-weight: bold; color: white; font-weight:bold">Campo 2: </td>
                                <td style="padding: 10px 0; color: white;">
                                    <a href="<?= $data['field'] ?>" style="color: white">Link</a>
                                </td>     
                            </tr>
                        </tbody>
                    </table>
                </div>

                <footer style="text-align: center; font-size: 12px; font-family: Sans-Serif; padding: 1rem; color: #6600EC; background: white;">
                    All rights reserved - Panda WP
                </footer>         
            </div>
            </td>
        </tr>
        </table>
    </td>
    </tr>
</table> 
