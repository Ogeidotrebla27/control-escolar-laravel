<!DOCTYPE html>
<html>
<head>
    <title>Test Subida</title>
</head>
<body>
    <h1>Test de Subida de Archivos</h1>
    
    <form action="{{ route('alumnos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <label>Nombre:</label>
        <input type="text" name="nombre" value="Test" required>
        <br><br>
        
        <label>Apellidos:</label>
        <input type="text" name="apellidos" value="Test" required>
        <br><br>
        
        <label>CURP:</label>
        <input type="text" name="curp" value="TEST123456789012" required>
        <br><br>
        
        <label>Fecha Nacimiento:</label>
        <input type="date" name="fecha_nacimiento" value="2010-01-01" required>
        <br><br>
        
        <label>Grado:</label>
        <input type="text" name="grado" value="1" required>
        <br><br>
        
        <label>Grupo:</label>
        <input type="text" name="grupo" value="A" required>
        <br><br>
        
        <label>Fecha Inscripción:</label>
        <input type="date" name="fecha_inscripcion" value="2026-01-01" required>
        <br><br>
        
        <label>Estatus:</label>
        <select name="estatus">
            <option value="Regular">Regular</option>
        </select>
        <br><br>
        
        <label>Estatus Documentos:</label>
        <select name="estatus_documentos">
            <option value="Incompleto">Incompleto</option>
        </select>
        <br><br>
        
        <label>Foto:</label>
        <input type="file" name="foto" accept="image/*">
        <br><br>
        
        <label>PDF:</label>
        <input type="file" name="pdf_documentos" accept=".pdf">
        <br><br>
        
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
