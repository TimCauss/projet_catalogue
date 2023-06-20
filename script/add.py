# import multithreading
import threading

# import time for some sleep
import time

# import urllib as dw pour le téléchargement des images
import urllib.request


# import undetected_chromedriver and selenium
import undetected_chromedriver as browser
from selenium import webdriver

from selenium.webdriver.support.wait import WebDriverWait
from selenium.webdriver.common.by import By
from selenium.common.exceptions import NoSuchElementException
from selenium.webdriver.support.select import Select
from selenium.webdriver.common.keys import Keys

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

# fonction qui renvoie un boolean en fonction de la présence d'un élement:


def check_exists(xpath, d):
    try:
        d.find_element(By.XPATH, xpath)
    except NoSuchElementException:
        return False
    return True


def check_exists_css(selector, d):
    try:
        d.find_element(By.CSS_SELECTOR, selector)
    except NoSuchElementException:
        return False
    return True

# fonction qui retirer la dernière virgule d'une chaine de caractère:


def remove_last_comma(s):
    if s[-1] == ",":
        s = s[:-1]
    return s

# La fonction de scraping:


def scrapper(range_start, range_end):
    options = webdriver.ChromeOptions()
    options.add_argument("--disable-blink-features=AutomationControlled")
    d = browser.Chrome(options=options, enable_console_log=True)
    wait = WebDriverWait(d, 3, 0.2)
    count = 0

    for i in range(int(range_start), int(range_end)):
        d.implicitly_wait(5)
        d.get("https://www.pokemon.com/fr/pokedex")

        count += 1

        if count == 1:
            wait.until(lambda d: d.find_element(
                By.ID, "onetrust-reject-all-handler")).click()
        wait.until(lambda d: d.find_element(By.ID, "searchInput")).send_keys(i)
        d.find_element(By.ID, "searchInput").send_keys(Keys.RETURN)

        time.sleep(1)
        wait.until(lambda d: d.find_element(
            By.XPATH, "/html/body/div[4]/section[5]/ul/li[1]/a/img")).click()

        # On récupère les infos du pokemon:

        p_numero = add_zero(str(i))
        p_nom = keep_word(wait.until(lambda d: d.find_element(
            By.XPATH, "/html/body/div[4]/section[1]/div[2]/div")).text, 0)

        p_description = wait.until(lambda d: d.find_element(
            By.XPATH, "/html/body/div[4]/section[3]/div[2]/div/div[1]")).text

        p_taille = d.find_element(
            By.XPATH, ("//*[contains(text(),'Taille')]/following-sibling::span")).text
        p_poids = d.find_element(
            By.XPATH, ("//*[contains(text(),'Poids')]/following-sibling::span")).text
        p_type = d.find_element(
            By.XPATH, ("//*[contains(text(),'Type')]/following-sibling::ul/li[1]/a")).text
        # On gère le cas où le pokemon n'a pas de second type:
        ptype2_xpath = "//*[contains(text(),'Type')]/following-sibling::ul/li[2]/a"
        if (check_exists(ptype2_xpath, d) == True):
            p_type2 = d.find_element(
                By.XPATH, ("//*[contains(text(),'Type')]/following-sibling::ul/li[2]/a")).text
        else:
            p_type2 = "Type"

        # On gère l'image
        img = d.find_element(
            By.XPATH, "//img[@alt='" + p_nom + "']")
        urllib.request.urlretrieve(img.get_attribute("src"),
                                   "C:\\laragon\\www\\projet_catalogue\\img\\pokemon\\" + p_nom + ".png")

        # On gère les évo, on créer une boucle de 3:
        p_evo = ""
        for j in range(1, 4):

            locator = ".evolution-profile > li:nth-child(" + str(
                j) + ") > a:nth-child(1) > h3:nth-child(2)"

            if (check_exists_css(locator, d) == True):
                p_evo += keep_word(d.find_element(By.CSS_SELECTOR,
                                   locator).text, 0) + ","
            else:
                p_evo += ""

        if count == 1:
            d.get("http://localhost/projet_catalogue/profil.php")
            wait.until(lambda d: d.find_element(By.ID, "login-email")
                       ).send_keys("jesuisun@bot.fr")
            d.find_element(By.ID, "login-pass").send_keys("123456@#")
            time.sleep(0.1)
            d.find_element(By.ID, "submitLogin").click()

        d.get("http://localhost/projet_catalogue/profil.php")
        d.find_element(
            By.XPATH, "//*[contains(text(),'Ajouter')]").click()
        wait.until(lambda d: d.find_element(By.ID, "nom")).send_keys(p_nom)
        d.find_element(By.ID, "numero").send_keys(i)
        d.find_element(By.ID, "description").send_keys(p_description)
        d.find_element(By.ID, "taille").send_keys(keep_word(p_taille, 0))
        d.find_element(By.ID, "poids").send_keys(keep_word(p_poids, 0))

        if p_type == "Électrik":
            p_type = "Electrik"
        elif (p_type == "Fée"):
            p_type = "Fee"
        elif (p_type == "Ténèbres"):
            p_type = "Tenebres"

        type_select = d.find_element(By.NAME, "type")
        select = Select(type_select)
        select.select_by_visible_text(p_type)

        if p_type2 == "":
            p_type2 = "Type"
        elif p_type2 == "Électrik":
            p_type2 = "Electrik"
        elif (p_type2 == "Fée"):
            p_type2 = "Fee"
        elif (p_type2 == "Ténèbres"):
            p_type2 = "Tenebres"

        type2_select = d.find_element(By.NAME, "type-2")
        select2 = Select(type2_select)
        select2.select_by_visible_text(p_type2)

        d.find_element(By.ID, "evolutions").send_keys(
            remove_last_comma(p_evo))

        d.find_element(By.ID, "p_img").send_keys(
            "C:\\laragon\\www\\projet_catalogue\\img\\pokemon\\" + p_nom + ".png")
        d.find_element(By.ID, "submit").submit()


"""         d.find_element(
            By.XPATH, "/html/body/section/div/div[2]/form/div[7]/input").click() """


# Section des threads:
thread = threading.Thread(target=scrapper, args=(
    range_start, range_end))  # fonction de scraping
""" thread2= threading.Thread(target=scrapper, args=(range_start, range_end))#fonction de scraping """

thread.start()  # on lance le thread
""" thread2.start()#on lance le thread """
