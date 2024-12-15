<?php 

   $selectLogs = "SELECT 
    a.user_id,          
    u.name,              
    u.role,              
    a.activity_details,           
    a.session_start,    
    a.session_end      
FROM 
    activity_logs a
JOIN 
    users u ON a.user_id = u.id 
ORDER BY 
    a.created_at; 
";

    //make query and get results using the parameters (connection to be used, query to be used)
    $result = mysqli_query($conn, $selectLogs);

    //fetch resulting rows as an array using the parameters (array to be used, MYSQLI_ASSOC)
    $logs = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //releases results to avoid stacking up memory
    mysqli_free_result($result);

    ?>