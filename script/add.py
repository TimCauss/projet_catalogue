# import multithreading
import threading

import time


# import undetected_chromedriver and selenium
import undetected_chromedriver as browser
from selenium import webdriver

from selenium.webdriver.support.wait import WebDriverWait
from selenium.webdriver.common.by import By
from selenium.common.exceptions import NoSuchElementException

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

# fonction qui garde que le mot n d'une chaine de caractère:


def keep_word(s, n):
    return (s.split(" "))[n]


# La fonction de scraping:
def scrapper(range_start, range_end):
    options = webdriver.ChromeOptions()
    options.add_argument("--disable-blink-features=AutomationControlled")
    driver = browser.Chrome(options=options, enable_console_log=True)
    wait = WebDriverWait(driver, 3, 0.2)

    for i in range(int(range_start), int(range_end)):
        driver.implicitly_wait(5)
        driver.get("https://www.pokemon.com/fr/pokedex")

        if i == 1:
            wait.until(lambda d: d.find_element(
                By.ID, "onetrust-reject-all-handler")).click()
        wait.until(lambda d: d.find_element(By.ID, "searchInput")).send_keys(i)
        wait.until(lambda d: d.find_element(By.ID, "search")).click()
        time.sleep(1)
        wait.until(lambda d: d.find_element(
            By.XPATH, "/html/body/div[4]/section[5]/ul/li[1]/a/img")).click()

        # On récupère les infos du pokemon:

        p_numero = add_zero(str(i))
        p_nom = wait.until(lambda d: d.find_element(
            By.XPATH, "/html/body/div[4]/section[1]/div[2]/div").text)
        p_description = wait.until(lambda d: d.find_element(
            By.XPATH, "/html/body/div[4]/section[3]/div[2]/div/div[1]").text)

        p_taille = driver.find_element(
            By.XPATH, ("//*[contains(text(),'Taille')]/following-sibling::span")).text
        p_poids = driver.find_element(
            By.XPATH, ("//*[contains(text(),'Poids')]/following-sibling::span")).text
        p_type = driver.find_element(
            By.XPATH, ("//*[contains(text(),'Type')]/following-sibling::ul/li[1]/a")).text

        # On gère le cas où le pokemon n'a pas de second type:

        print("Pokemon n°" + p_numero + " : " + keep_word(p_nom, 0))
        print("Description : " + p_description)
        print("Taille : " + keep_word(p_taille, 0))
        print("Poids : " + keep_word(p_poids, 0))
        print("Type : " + p_type)
        input("Press Enter to continue...")

        driver.get("http://localhost/projet_catalogue/profil.php")
        wait.until(lambda d: d.find_element(By.ID, "login-email")
                   ).send_keys("jesuisun@bot.fr")
        driver.find_element(By.ID, "login-pass").send_keys("123456")
        time.sleep(0.1)
        driver.find_element(By.ID, "submitLogin").click()
        driver.get("http://localhost/projet_catalogue/profil.php")
        input("Press Enter to continue...")


# Section des threads:
thread = threading.Thread(target=scrapper, args=(
    range_start, range_end))  # fonction de scraping
""" thread2= threading.Thread(target=scrapper, args=(range_start, range_end))#fonction de scraping """

thread.start()  # on lance le thread
""" thread2.start()#on lance le thread """
