import json # Importa la librería para manipular archivos jerárquicos JSON
import datetime # Importa el módulo para gestionar fechas y horas (timestamps)
import time # Importa funciones de manejo de tiempo (pausas)

def registrar_auditoria(mensaje):
    # Genera la fecha y hora actual en formato de texto año-mes-día hora:minuto:segundo
    timestamp = datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")
    # Abre el archivo TXT en modo 'a' (Append) para añadir datos al final sin borrar lo anterior
    with open("auditoria.txt", "a", encoding="utf-8") as f:
        # Escribe la línea de log con el tiempo y el mensaje de éxito o alerta
        f.write(f"[{timestamp}] {mensaje}\n")

try:
    # Abre el archivo JSON de configuración en modo lectura ('r')
    with open('usuarios.json', 'r', encoding='utf-8') as f:
        # Convierte el contenido del archivo JSON en una lista de diccionarios de Python
        usuarios = json.load(f)

    print("--- SISTEMA DE CONTROL DE ACCESO ---")
    # Solicita la entrada de datos por consola (simula el escaneo del sensor)
    tarjeta_input = input("Escanee su tarjeta (Ingrese ID): ")

    # Busca en la lista el primer usuario cuyo ID coincida con la entrada; si no hay, devuelve None
    usuario_encontrado = next((u for u in usuarios if u['id_tarjeta'] == tarjeta_input), None)

    # Verifica si se encontró un usuario válido
    if usuario_encontrado:
        # Prepara el mensaje de éxito extrayendo el nombre desde el objeto JSON
        msg = f"ACCESO CONCEDIDO - Usuario: {usuario_encontrado['nombre_empleado']}"
        print("CERRADURA ABIERTA por 5 segundos...")
        # Llama a la función para guardar el registro en el archivo secuencial TXT
        registrar_auditoria(msg)
        time.sleep(5) # Pausa el programa 5 segundos para simular el proceso físico del actuador
    else:
        # Prepara un mensaje de error si el ID no existe en la base de datos
        msg = "ALERTA - Intento de acceso no autorizado - ID: " + tarjeta_input
        print("ALARMA ACTIVADA")
        # Registra la alerta en el archivo de auditoría para supervisión posterior
        registrar_auditoria(msg)

except Exception as e:
    # Atrapa cualquier error (como falta de archivos o formato JSON inválido) para evitar el cierre del sistema
    print(f"ERROR TÉCNICO: {e}")