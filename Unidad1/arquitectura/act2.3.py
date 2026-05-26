import time 
import random 

# Definición de tiempos (en segundos)
TIEMPO_CACHE = 0.000001 
TIEMPO_RAM   = 0.0001   

# Diferentes tecnologías de disco
TIEMPO_HDD   = 0.01    # 10 ms (Mecánico - Lento)
TIEMPO_SSD   = 0.0001  # 0.1 ms (Estado Sólido - Rápido)

def acceso_memoria(tipo, tiempo, n): 
    inicio = time.time()
    for _ in range(n): 
        x = random.randint(1, 100) 
        time.sleep(tiempo) 
    fin = time.time() 
    return fin - inicio 

# --- PRUEBA CON n = 500 (Carga ligera) ---
n_bajo = 500
print(f"--- SIMULACIÓN CON {n_bajo} ACCESOS ---")
t_hdd_bajo = acceso_memoria("HDD", TIEMPO_HDD, n_bajo)
t_ssd_bajo = acceso_memoria("SSD", TIEMPO_SSD, n_bajo)
print(f"HDD: {t_hdd_bajo:.4f}s | SSD: {t_ssd_bajo:.4f}s\n")

# --- DESAFÍO: PRUEBA CON n = 2000 (Carga pesada) ---
n_alto = 2000
print(f"--- DESAFÍO: SIMULACIÓN CON {n_alto} ACCESOS ---")
t_cache = acceso_memoria("Caché", TIEMPO_CACHE, n_alto)
t_ram   = acceso_memoria("RAM", TIEMPO_RAM, n_alto)
t_hdd   = acceso_memoria("HDD", TIEMPO_HDD, n_alto)
t_ssd   = acceso_memoria("SSD", TIEMPO_SSD, n_alto)

print(f"Tiempo total en Caché: {t_cache:.4f} seg") 
print(f"Tiempo total en RAM:   {t_ram:.4f} seg") 
print(f"Tiempo total en SSD:   {t_ssd:.4f} seg") 
print(f"Tiempo total en HDD:   {t_hdd:.4f} seg")