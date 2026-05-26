def generar_datos():
    with open("clientes.txt", "w", encoding="utf-8") as f:
        f.write("1,Valeria\n")
        f.write("2,Pedro\n")
    
    with open("pedidos.txt", "w", encoding="utf-8") as f:
        f.write("101,Valeria,Laptop\n")
        f.write("102,Valeria,Mouse\n")

def simular_actualizacion(id_buscado, nuevo_nombre):
    print(f"Actualizando ID {id_buscado} a: {nuevo_nombre}...")
    
    # Intento de actualización en el primer archivo
    print("Modificando clientes.txt...")
    
    # Intento de actualización en el segundo archivo (redundancia)
    print("Modificando pedidos.txt para evitar errores...")
    
    print("\nResultado: Se tuvo que procesar cada archivo por separado para mantener la consistencia.")

generar_datos()
simular_actualizacion(1, "Valeria Garcia")
simular_actualizacion(2, "Yajaira Vargas")