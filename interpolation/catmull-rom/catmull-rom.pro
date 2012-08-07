#-------------------------------------------------
#
# Project created by QtCreator 2012-08-07T22:19:42
#
#-------------------------------------------------

QT       += core gui

greaterThan(QT_MAJOR_VERSION, 4): QT += widgets

TARGET = catmull-rom
TEMPLATE = app

OBJECTS_DIR = build/objects
MOC_DIR = build/moc
UI_DIR = build/ui

SOURCES += src/main.cpp \
        src/mainwindow.cpp

HEADERS  += src/mainwindow.h

FORMS    += src/ui/mainwindow.ui
