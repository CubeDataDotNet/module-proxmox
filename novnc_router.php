<?php
// TASK: Take Blesta request, add browser cookie, then redirect to noVNC
if (isset($_GET['pveticket']) && isset($_GET['host']) && isset($_GET['path']) && isset($_GET['vncticket']) && isset($_GET['portid']) && isset($_GET['passwordid'])) {
    $pveticket = $_GET['pveticket'];
    $vncticket = $_GET['vncticket'];
    $host = $_GET['host'];
    $path = $_GET['path'];
	$portid = $_GET['portid'];
	$passwordid = $_GET['passwordid'];

    // Get the requesting hostname/domain from request
    $blestadomain = parse_url($host);
    //$domainonly = preg_replace("/^(.*?)\.(.*)$/","$2",$blestadomain['path']);

    // Create the final noVNC URL with the re-encoded vncticket
    $hostname = gethostbyaddr($host);
	//setrawcookie('PVEAuthCookie', $pveticket, 0, '/', "74.118.135.5:8006");
    $redirect_url = '/components/modules/proxmox/views/default/novnc/vnc.html?autoconnect=true&encrypt=true&host=' . $hostname . '&port='.$portid.'&password=' . urlencode($vncticket) . '&path=' . urlencode($path);
	
    header('Location: ' . $redirect_url);
    exit;
} else {
    echo 'Error: Missing required info to route your request. Please try again.';
}
?>