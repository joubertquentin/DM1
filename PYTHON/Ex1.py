# Afficher le menu contenant les options
def afficher_menu():
    print("\n") 
    print("1 : Ajouter une tâche")
    print("2 : Afficher les tâches")
    print("3 : Supprimer une tâche")
    print("4 : Quitter")

# Choisir une des options de la fonction "afficher_menu()"
def choisir_option():
    taches = []

    while True:
        afficher_menu()
        print("\n")
        choix = input("Choisir une option avec le numéro : ")
# Option 1
        if choix == '1':
            tache = input("Nom de la tâche : ")
            taches.append(tache)
            print(f"Tâche ajoutée : {tache}")
   # Option 2     
        elif choix == '2':
            if taches:
                print("Liste des tâches :")
                for i, tache in enumerate(taches, start=1):
                    print(f"{i} : {tache}")
            else:
                print("Aucune tâche à afficher.")
    # Option 3
        elif choix == '3':
            if taches:
                afficher_taches(taches)
                numero = input("Numéro de la tâche à supprimer : ")
                try:
                    index = int(numero) - 1
                    if 0 <= index < len(taches):
                        tache_supprimee = taches.pop(index)
                        print(f"Tâche supprimée : {tache_supprimee}")
                    else:
                        print("Numéro de tâche invalide.")
                except ValueError:
                    print("Un numéro valide doit être rentré.")
            else:
                print("Aucune tâche à supprimer.")
    # Option 4
        elif choix == '4':
            break
        
        else:
            print("Choix invalide.")
# Afficher la liste des tâches
def afficher_taches(taches):
    print("Liste des tâches :")
    for i, tache in enumerate(taches, start=1):
        print(f"{i} : {tache}")
# Afficher la fonction "choisir_option" si le nom est égal à "main"
if __name__ == "__main__":
    choisir_option()


