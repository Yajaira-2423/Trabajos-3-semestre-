import csv
import json

# 1. Leer el archivo CSV
datos_filtrados = []

with open('inventario.csv', encoding='utf-8') as f:
    lector_csv = csv.DictReader(f)
    for fila in lector_csv:
        # Convertimos los valores a tipos numéricos para poder comparar
        precio = float(fila['precio'])
        stock = int(fila['stock'])
        
        # DESAFÍO: Filtrar solo productos con precio > 100
        if precio > 100:
            fila['precio'] = precio
            fila['stock'] = stock
            datos_filtrados.append(fila)

# 2. Guardar como JSON
with open('inventario.json', 'w', encoding='utf-8') as f:
    json.dump(datos_filtrados, f, indent=4, ensure_ascii=False)

print(f"¡Conversión exitosa! Se guardaron {len(datos_filtrados)} productos de alto valor.")