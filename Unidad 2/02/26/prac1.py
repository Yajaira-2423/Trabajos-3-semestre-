import time
import os

# 1. GENERACIÓN: Creamos el archivo con 1 millón de registros
def generar_datos():
    print("Generando 1,000,000 de registros... (espera un momento)")
    with open("datos_masivos.txt", "w") as f:
        for i in range(1, 1000001):
            f.write(f"{i},usuario{i}@correo.com,{i*10}\n")
    print("Archivo generado con éxito.\n")

# 2. PRUEBA A: Búsqueda Secuencial (Línea por línea)
def prueba_secuencial(id_buscado):
    inicio = time.time()
    encontrado = None
    
    with open("datos_masivos.txt", "r") as f:
        for linea in f:
            datos = linea.strip().split(",")
            if datos[0] == str(id_buscado):
                encontrado = datos
                break
    
    fin = time.time()
    return (fin - inicio) * 1000  # Convertir a milisegundos

# 3. PRUEBA B: Búsqueda Indexada (Diccionario/Hash)
def prueba_indexada(id_buscado):
    # Primero cargamos a memoria (Indexación)
    inicio_carga = time.time()
    indice = {}
    with open("datos_masivos.txt", "r") as f:
        for linea in f:
            datos = linea.strip().split(",")
            indice[datos[0]] = datos
    
    # Medimos solo la búsqueda
    inicio_busqueda = time.time()
    resultado = indice.get(str(id_buscado))
    fin_busqueda = time.time()
    
    return (fin_busqueda - inicio_busqueda) * 1000

# --- EJECUCIÓN ---
if __name__ == "__main__":
    if not os.path.exists("datos_masivos.txt"):
        generar_datos()

    id_objetivo = 1000000  # El último de la lista para el peor escenario
    
    tiempo_sec = prueba_secuencial(id_objetivo)
    tiempo_ind = prueba_indexada(id_objetivo)

    print(f"--- RESULTADOS (ID Buscado: {id_objetivo}) ---")
    print(f"Tiempo Secuencial: {tiempo_sec:.4f} ms")
    print(f"Tiempo Indexado:   {tiempo_ind:.4f} ms")
    
    diferencia = tiempo_sec / tiempo_ind if tiempo_ind > 0 else 0
    print(f"\n¡La búsqueda indexada es {diferencia:.0f} veces más rápida!")