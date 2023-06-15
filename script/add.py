# import multithreading
import threading


# import undetected_chromedriver and selenium
import undetected_chromedriver as browser
from selenium import webdriver
from selenium.webdriver.support.wait import WebDriverWait
from selenium.webdriver.common.by import By

# On prépare les variables utilisateurs:
range_start = input("Starting range of pokemon number: ")
range_end = input("Ending range of pokemon number: ")

# Fonction qui rajoute des 0 devant le numéro du pokemon si celui-ci est inférieur à 4 chiffres:


def add_zero(p_numero):
    if len(p_numero) == 1:
        p_numero = "000" + p_numero
    elif len(p_numero) == 2:
        p_numero = "00" + p_numero
    elif len(p_numero) == 3:
        p_numero = "0" + p_numero
    return str(p_numero)

# fonction qui garde que le premier mot d'une chaine de caractère:


def keep_first_word(s):
    return (s.split(" "))[0]


# La fonction de scraping:
def scrapper(range_start, range_end):
    options = webdriver.ChromeOptions()
    options.add_argument("--disable-blink-features=AutomationControlled")
    driver = browser.Chrome(options=options, enable_console_log=True)
    driver.implicitly_wait(10)
    for i in range(int(range_start), int(range_end)):
        driver.get("https://www.pokemon.com/fr/pokedex")
        if i == 1:
            driver.find_element(By.ID, "onetrust-reject-all-handler").click()
        e_search = WebDriverWait(driver, timeout=3).until(
            lambda d: d.find_element(By.ID, "searchInput"))
        e_search.send_keys(i)
        driver.find_element(By.ID, "search").click()
        e_found = WebDriverWait(driver, timeout=3).until(lambda d: d.find_element(
            By.XPATH, "/html/body/div[4]/section[5]/ul/li[1]/a/img"))
        e_found.click()

        # On récupère les infos du pokemon:

        p_numero = add_zero(str(i))
        p_nom = driver.find_element(
            By.XPATH, "/html/body/div[4]/section[1]/div[2]/div").text
        p_description = driver.find_element(
            By.XPATH, "/html/body/div[4]/section[3]/div[2]/div/div[1]").text
        try:
            p_taille = driver.find_element(
                By.XPATH, "/html/body/div[4]/section[3]/div[2]/div/div[3]/div[1]/div[1]/ul/li[1]/span[2]").text
        except:

            # TODO Faire des Try pour les détecter les pokémon avec le Selecteur car rajout d'un élément dans le DOM
            p_taille = driver.find_element(
                By.XPATH, "/html/body/div[4]/section[3]/div[2]/div/div[5]/div[1]/div[1]/ul/li[1]/span[2]").text
        p_poids = driver.find_element(
            By.XPATH, "/html/body/div[4]/section[3]/div[2]/div/div[3]/div[1]/div[1]/ul/li[2]/span[2]").text
        p_type = driver.find_element(
            By.XPATH, "/html/body/div[4]/section[3]/div[2]/div/div[3]/div[2]/div[1]/ul/li[1]/a").text
        # On gère le cas où le pokemon n'a pas de second type:
        try:
            p_type2 = driver.find_element(
                By.XPATH, "/html/body/div[4]/section[3]/div[2]/div/div[3]/div[2]/div[1]/ul/li[2]/a").text
        except:
            p_type2 = ""
            raise
        # On gère les Evolutions:
        evo = []
        for n in range(1, 4):
            try:
                evo.append(keep_first_word(driver.find_element(
                    By.XPATH, "/html/body/div[4]/section[4]/div/ul/li[" + str(n) + "]/a/h3").text))
            except:
                evo.append(keep_first_word(p_nom))
                break

        print("Pokemon n°" + p_numero + " : " + keep_first_word(p_nom))
        print(p_description)
        print("Taille : " + keep_first_word(str(p_taille)))
        print("Poids : " + keep_first_word(str(p_poids)))
        print("Type : " + p_type)
        print("Type 2 : " + p_type2)
        print("Evolutions : ",  evo)

        input("Press Enter to continue...")


# Section des threads:
thread = threading.Thread(target=scrapper, args=(
    range_start, range_end))  # fonction de scraping
""" thread2= threading.Thread(target=scrapper, args=(range_start, range_end))#fonction de scraping """

thread.start()  # on lance le thread
""" thread2.start()#on lance le thread """
