@echo off
title Git Project Updater
color 0A

echo ========================================
echo    Updating Git Repository...
echo ========================================
echo.

cd /d "%~dp0"

echo Current directory: %CD%
echo.

REM Check if this is a git repository
if not exist ".git" (
    echo [ERROR] This folder is not a Git repository!
    echo Make sure this .bat file is in your project folder.
    goto :end
)

echo Current branch:
git branch --show-current
echo.

echo Pulling latest changes...
git pull

if %errorlevel% neq 0 (
    echo.
    echo [ERROR] Git pull failed. Check the messages above.
) else (
    echo.
    echo [SUCCESS] Project updated successfully!
)

:end
echo.
pause