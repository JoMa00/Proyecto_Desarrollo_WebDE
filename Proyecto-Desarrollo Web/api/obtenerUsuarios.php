<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once __DIR__ . '/../dao/UsuarioDAO.php';

try {
    // Obtener parámetros de paginación
    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $registrosPorPagina = isset($_GET['limite']) ? (int)$_GET['limite'] : 8;
    
    // Calcular inicio
    $inicio = ($pagina - 1) * $registrosPorPagina;
    
    // Obtener todos los usuarios
    $dao = new UsuarioDAO();
    $todosUsuarios = $dao->listarTodos();
    $totalUsuarios = count($todosUsuarios);
    
    // Cortar el array para esta página
    $usuarios = array_slice($todosUsuarios, $inicio, $registrosPorPagina);
    
    // Calcular total de páginas
    $totalPaginas = ceil($totalUsuarios / $registrosPorPagina);
    
    // Preparar respuesta
    $response = [
        'success' => true,
        'data' => $usuarios,
        'paginacion' => [
            'paginaActual' => $pagina,
            'registrosPorPagina' => $registrosPorPagina,
            'totalUsuarios' => $totalUsuarios,
            'totalPaginas' => $totalPaginas
        ]
    ];
    
    echo json_encode($response);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Error al obtener usuarios: ' . $e->getMessage()
    ]);
}
?>
