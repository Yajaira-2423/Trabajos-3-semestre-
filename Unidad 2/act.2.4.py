import time
import os

def ejecutar_prueba_estres():
    archivo = "datos_masivos.txt"
    id_objetivo = "1000000" # El último registro (peor escenario)

    # 1. GENERACIÓN (Si no existe)
    if not os.path.exists(archivo):
        print("Generando 1,000,000 de registros...")
        with open(archivo, "w") as f:
            for i in range(1, 1000001):
                f.write(f"{i},usuario{i}@correo.com,{i*10}\n")

    # 2. PRUEBA A: Secuencial (O(n))
    print("Iniciando Búsqueda Secuencial...")
    inicio_sec = time.time()
    with open(archivo, "r") as f:
        for linea in f:
            if linea.split(',')[0] == id_objetivo:
                break
    t_secuencial = (time.time() - inicio_sec) * 1000

    # 3. PRUEBA B: Indexada/Hash (O(1))
    print("Iniciando Búsqueda Indexada (Hash)...")
    # Primero indexamos (esto es el costo de mantenimiento)
    indice = {}
    with open(archivo, "r") as f:
        for linea in f:
            datos = linea.split(',')
            indice[datos[0]] = datos

    # Medimos la recuperación pura
    inicio_ind = time.time()
    resultado = indice.get(id_objetivo)
    t_indexada = (time.time() - inicio_ind) * 1000

    # 4. VISUALIZACIÓN
    print(f"\n--- RESULTADOS EN LX15PRO ---")
    print(f"Tiempo Secuencial: {t_secuencial:.4f} ms")
    print(f"Tiempo Indexado:   {t_indexada:.4f} ms")
    
    factor = t_secuencial / t_indexada if t_indexada > 0 else 0
    print(f"\nConclusión: El acceso Directo es {factor:.0f} veces más rápido.")

ejecutar_prueba_estres()