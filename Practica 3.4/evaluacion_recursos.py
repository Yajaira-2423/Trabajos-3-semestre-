import time
import os
import json
import csv

def medir_procesamiento_csv(archivo_csv):
    print("--- Evaluando Formato CSV ---")
    inicio_cpu = time.process_time()
    inicio_tiempo = time.time()
    
    # 1. Lectura Completa en Memoria
    with open(archivo_csv, mode='r', encoding='utf-8') as f:
        lector = list(csv.DictReader(f))
    
    # 2. Conversión a estructura JSON (en memoria)
    datos_json = json.dumps(lector, indent=4)
    
    # 3. Escritura masiva en disco
    archivo_salida = "copia_ventas.csv"
    with open(archivo_salida, mode='w', encoding='utf-8', newline='') as f:
        if lector:
            escritor = csv.DictWriter(f, fieldnames=lector[0].keys())
            escritor.writeheader()
            escritor.writerows(lector)
            
    fin_cpu = time.process_time()
    fin_tiempo = time.time()
    
    # Mediciones de recursos
    tamano_disco = os.path.getsize(archivo_csv) / 1024  # En KB
    tiempo_total = fin_tiempo - inicio_tiempo
    cpu_utilizado = fin_cpu - inicio_cpu
    
    print(f"Tamaño en Disco: {tamano_disco:.2f} KB")
    print(f"Tiempo de Reloj (Total): {tiempo_total:.4f} segundos")
    print(f"Tiempo de CPU dedicado: {cpu_utilizado:.4f} segundos")
    return tiempo_total, tamano_disco

def medir_procesamiento_json(archivo_json, datos_originales_csv):
    # Primero creamos el archivo JSON de prueba basándonos en tu CSV
    with open(datos_originales_csv, mode='r', encoding='utf-8') as f:
        lector = list(csv.DictReader(f))
    with open(archivo_json, mode='w', encoding='utf-8') as f:
        json.dump(lector, f, indent=4)
        
    print("\n--- Evaluando Formato JSON ---")
    inicio_cpu = time.process_time()
    inicio_tiempo = time.time()
    
    # 1. Lectura Completa en Memoria
    with open(archivo_json, mode='r', encoding='utf-8') as f:
        datos = json.load(f)
        
    # 2. Conversión a estructura de texto (Simulando paso a CSV)
    lineas_csv = []
    if datos:
        columnas = list(datos[0].keys())
        lineas_csv.append(",".join(columnas))
        for fila in datos:
            lineas_csv.append(",".join(str(fila[col]) for col in columnas))
            
    # 3. Escritura masiva en un nuevo archivo
    with open("copia_ventas.json", mode='w', encoding='utf-8') as f:
        json.dump(datos, f, indent=4)
        
    fin_cpu = time.process_time()
    fin_tiempo = time.time()
    
    tamano_disco = os.path.getsize(archivo_json) / 1024  # En KB
    tiempo_total = fin_tiempo - inicio_tiempo
    cpu_utilizado = fin_cpu - inicio_cpu
    
    print(f"Tamaño en Disco: {tamano_disco:.2f} KB")
    print(f"Tiempo de Reloj (Total): {tiempo_total:.4f} segundos")
    print(f"Tiempo de CPU dedicado: {cpu_utilizado:.4f} segundos")
    return tiempo_total, tamano_disco

# --- EJECUCIÓN PRINCIPAL ---
if __name__ == "__main__":
    archivo_base = "ventas_tecnologia.csv"
    archivo_temporal_json = "ventas_tecnologia.json"
    
    if os.path.exists(archivo_base):
        t_csv, size_csv = medir_procesamiento_csv(archivo_base)
        t_json, size_json = medir_procesamiento_json(archivo_temporal_json, archivo_base)
    else:
        print(f"Error: No se encontró el archivo {archivo_base} en esta carpeta.")