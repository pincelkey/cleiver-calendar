<table style="border: solid 1px #661FFF;">
    <tr>
        <th style="background: #661FFF; color: white;">ID</th>
        <th style="background: #661FFF; color: white;">Fecha</th>
    </tr>
    <tbody>
        <?php 
            $index = 0;

            foreach($tickets as $ticket) { 
                $bg     = ( $index % 2 == 0 ) ? '#EEE8F6' : 'white';
        ?>
            <tr>
                <td style="background: <?php echo $bg; ?>;"><?php echo $ticket->id ?></td>
                <td style="background: <?php echo $bg; ?>;"><?php echo $ticket->date_at ?></td>
            </tr>
        <?php $index++; } ?>
    </tbody>
</table>
