import threading 
import time 

def tarea(): 
    suma = 0              
    for i in range(10**7): 
        suma += i        
    print("Fin de la tarea") 

# Ejecución secuencial 
inicio = time.time() 
tarea() 
tarea() 
fin = time.time() 
print("Tiempo secuencial:", fin - inicio) 

# Ejecución con multihilos 
inicio = time.time() 
t1 = threading.Thread(target=tarea) 
t2 = threading.Thread(target=tarea) 
t1.start() 
t2.start() 
t1.join() 
t2.join() 
fin = time.time() 
print("Tiempo multihilos:", fin - inicio)