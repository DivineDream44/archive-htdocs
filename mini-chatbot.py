#*********************************
# Nom : mini-chatbot
# Rôle : répondre à des "bonjour", "bonsoir", et un minimum de 5 questions simples
# Auteur : Louane Caris
# Version : V0.1 du 11/06/2026
# Licence : réalisé dans le cadre du cours d'informatique fondamentale
# Exercice : 7.2 - Mini-projet
# Compilation : Python 3.13.1
#*********************************

import random

#Définition des réponses pour les salutations
salutations_replies = {
    "bonjour": [
        "Bonjour ! Comment puis-je vous aider aujourd'hui ?",
        "Bonjour ! Je suis un chatbot, ravi de vous rencontrer !",
        "Bonjour ! N'hésitez pas à me poser des questions."
    ],
    "bonsoir": [
        "Bonsoir ! Comment puis-je vous aider ?",
        "Bonsoir ! Je suis un chatbot, n'hésitez pas à me poser des questions.",
        "Bonsoir ! Je suis là si vous avez besoin d'aide."
    ],
    "salut": [
        "Salut ! Qu'est-ce que je peux faire pour toi ?",
        "Salut ! Je suis un chatbot !"
    ]
}

#Questions choisies : âge, nom, métier, localisation, couleur préférée
questions_replies = {
    #Question 1 : nom
    "nom": [
        "Je m'appelle Mini-chatbot !",
        "Mon nom est Mini-chatbot ! Je suis un chatbot créé pour l'exercice 7.2.",
        "Je suis Mini-chatbot."
    ],
    
    # Question 2 : âge
    "âge": [
        "Je n'ai pas d'âge réel, je suis un programme informatique !",
        "En tant que chatbot, je n'ai pas d'âge humain."
    ],
    
    # Question 3 : métier
    "fonction": [  
        "Je suis un chatbot qui discute avec les humains. Je peux répondre à des salutations et quelques questions simples.",
        "Mon rôle est de pouvoir dialoguer et répondre à 'bonjour', 'bonsoir', et à 5 questions basiques."
    ],
    
    # Question 4 : localisation
    "habite": [
        "J'habite dans ton ordinateur, dans ce fichier Python !",
        "Je n'ai pas de maison physique. Je réside dans le code mini_chatbot.py.",
        "Mon domicile est virtuel : je suis stocké dans ce programme Python."
    ],
    
    # Question 5 : couleur préférée
    "couleur": [
        "Ma couleur préférée est le rose !",
        "Je préfère le violet.",
        "Le orange est ma couleur favorite !"
    ]
}

#Phrases pour les messages non reconnus
messages_replies = [
    "Je n'ai pas compris votre question. Essayez 'bonjour', 'bonsoir', ou posez-moi une de mes 5 questions : nom, âge, métier, habitation, couleur préférée.",
    "Humm, je ne sais pas répondre à ça. Posez-moi plutôt : 'Quel est ton nom ?', 'Tu as quel âge ?', etc.",
    "Désolé, je ne comprends pas. Je réponds seulement à : bonjour, bonsoir, et 5 questions simples."
]

#Fonction principale
def chatbot_reponses(user_input):
    
    #Conversion en lowercase
    input_lower = user_input.lower().strip()
    
    #Salutations
    for salutation, replies in salutations_replies.items():
        if salutation in input_lower:
            #Réponse aléatoire parmi les propositions
            return random.choice(replies)

    #Questions simples
    for question_key, replies in questions_replies.items():
        #Recherche du mot-clé
        if question_key in input_lower:
            return random.choice(replies)

    #Message non reconnu
    return random.choice(messages_replies)

#Fonction pour exécuter le chatbot en interactif
def main():
    print("Bienvenue dans le Mini-Chatbot !")
    print("Je peux répondre à 'bonjour', 'bonsoir', 'salut', et à 5 questions simples.")
    print("Questions disponibles : nom, âge, fonction, habitation, couleur préférée.")
    print("Tapez 'quitter' ou 'exit' pour sortir.\n")

    while True:
        #Entrée utilisateur
        user_input = input("Vous : ").strip()

        #Vérification de la sortie
        if user_input.lower() in ["quitter", "exit", "quit"]:
            print("Mini-chatbot : Au revoir !")
            break

        #Vérification de l'entrée
        if not user_input:
            print("Mini-chatbot : Vous n'avez rien écrit. Réessayez !")
            continue

        #Génération de la réponse
        reponse_bot = chatbot_reponses(user_input)
        print(f"Mini-chatbot : {reponse_bot}\n")

#Exécution du programme si ce fichier est directement lancé
if __name__ == "__main__":
    main()
