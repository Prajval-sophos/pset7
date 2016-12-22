<table class="table table-striped">
    <thead>
        <tr>
            <th>Transaction</th>
            <th>Date/Time</th>
            <th>Symbol</th>
            <th>Share</th>
            <th>Price</th>
        </tr>
    </thead>
    
    <tbody>
        <?php
        foreach ($history as $h)
        {
            print("<tr>");
            print("<td>{$h["transaction"]}</td>");
            print("<td>{$h["time"]}</td>");
            print("<td>{$h["symbol"]}</td>");
            print("<td>{$h["shares"]}</td>");
            print("<td>$".number_format($h["price"],2)."</td>");
            
            print("</tr>");
        }
    ?>
    </tbody>

</table>
