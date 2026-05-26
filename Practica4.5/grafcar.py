import json
import matplotlib.pyplot as plt
import os

# Obtener la ruta exacta de donde está tu script
ruta_actual = os.path.dirname(os.path.abspath(__file__))
ruta_json = os.path.join(ruta_actual, 'temperaturas.json')

# Cargar los datos usando la ruta completa
try:
    with open(ruta_json, 'r', encoding='utf-8') as archivo:
        datos = json.load(archivo)
except FileNotFoundError:
    print(f"Error: No se encontró el archivo en {ruta_json}")
    exit()

# Extraer los datos
meses = [item['mes'] for item in datos['temperaturas']]
minimas = [item['minima'] for item in datos['temperaturas']]
maximas = [item['maxima'] for item in datos['temperaturas']]

# Crear la gráfica
plt.figure(figsize=(10, 6))
plt.plot(meses, minimas, marker='o', label='Mínima', color='blue')
plt.plot(meses, maximas, marker='o', label='Máxima', color='red')

plt.title('Temperaturas por Mes')
plt.grid(True)
plt.legend()
plt.show()