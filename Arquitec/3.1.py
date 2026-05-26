# Simulación simple de transferencia en un bus 
# Memoria simulada (8 posiciones con valores) 
memoria = [10, 20, 30, 40, 50, 60, 70, 80] 

# CPU simulada 
cpu_registro = 0 

def leer_memoria(direccion): 
    global cpu_registro 
    # Paso 1: Bus de direcciones
    print(f"CPU coloca direccion {direccion} en el bus de direcciones") 
    # Paso 2: Bus de control
    print("CPU activa señal de LECTURA (R/W = 1) en el bus de control") 
    # Paso 3: Bus de datos
    cpu_registro = memoria[direccion] 
    print(f"Dato {cpu_registro} transferido por el bus de datos al CPU\n") 

def escribir_memoria(direccion, dato): 
    global cpu_registro 
    cpu_registro = dato 
    # Paso 1: Bus de direcciones
    print(f"CPU coloca direccion {direccion} en el bus de direcciones") 
    # Paso 2: Bus de control
    print("CPU activa señal de ESCRITURA (R/W = 0) en el bus de control") 
    # Paso 3: Bus de datos
    memoria[direccion] = cpu_registro 
    print(f"Dato {cpu_registro} transferido por el bus de datos a la memoria\n") 

# Ejemplo de uso (Simulando la interacción del sistema)
print("--- INICIO DE SIMULACIÓN DE BUSES ---\n")
leer_memoria(2)        # Leer valor de la posicion 2 
escribir_memoria(4, 99) # Escribir 99 en la posicion 4 
leer_memoria(4)        # Verificar escritura