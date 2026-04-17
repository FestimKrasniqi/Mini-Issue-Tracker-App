# Deploying Mini Issue Tracker to Render

This guide will help you deploy your Laravel Mini Issue Tracker application to Render.

## Prerequisites

- A [Render account](https://render.com) (free tier available)
- Your project pushed to a GitHub repository
- A valid email for Render account

## Step-by-Step Deployment

### 1. Generate APP_KEY (if not already done)

Generate a secure app key for your application:

```bash
cd issue-tracker
php artisan key:generate
```

Copy the `APP_KEY` value from your `.env` file (it will be something like `base64:xxxxx`).

### 2. Commit Render Files to GitHub

Push the new deployment files to your GitHub repository:

```bash
cd issue-tracker
git add Dockerfile .dockerignore
git commit -m "Add Render deployment configuration"
git push origin main
```

### 3. Create Render Service

1. Go to [https://dashboard.render.com](https://dashboard.render.com)
2. Click **"New +"** and select **"Web Service"**
3. Select **"Deploy from a Git repository"**
4. Connect your GitHub account and select your repository
5. Fill in the configuration:
   - **Name**: `mini-issue-tracker` (or your preferred name)
   - **Runtime**: Docker
   - **Branch**: `main`
   - **Build Command**: Leave blank (Dockerfile will handle it)
   - **Start Command**: Leave blank (Dockerfile will handle it)
   - **Plan**: Standard (free tier available during initial period)
   - **Region**: Choose closest to your users (e.g., Oregon, Virginia)
4. Create Database

1. In Render Dashboard, click **"New +"** and select **"PostgreSQL"**
2. Configure the database:
   - **Name**: `mini-issue-tracker-db`
   - **Database**: `mini_issue_tracker`
   - **User**: Render will generate a username
   - **Region**: Same as your web service
   - **Plan**: Free tier or Standard

3. Copy the database connection string from the database details page

### 5
### 5. Set Environment Variables

In your Render Web Service dashboard:

1. Go to **Environment** tab
2. Add these environment variables:

```
APP_NAME=Mini Issue Tracker
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app-name.onrender.com
APP_KEY=base64:your-generated-key-here
DB_CONNECTION=pgsql
DB_HOST=your-database-hostname.render.com
DB_PORT=5432
DB_DATABASE=mini_issue_tracker
DB_USERNAME=your-db-user
DB_PASSWORD=your-db-password
SESSION_DRIVER=cookie
CACHE_STORE=file
QUEUE_CONNECTION=sync
LOG_CHANNEL=stderr
```

**Important**: 
- Make sure `APP_ENV=production` is set (enables HTTPS forcing)
- `APP_URL` must be `https://` not `http://`
- `APP_DEBUG=false` in production for security

**Where to find these values:**
- **APP_KEY**: From your local `.env` file (the key you generated in Step 1)
- **APP_URL**: Your Render domain with HTTPS (example: `https://mini-issue-tracker-app.onrender.com`)
- **Database credentials**: From your PostgreSQL service details page on Render

### 6. Deploy

1. Click **"Create Web Service"** to start the deployment
2. Watch the deployment logs in the **Logs** tab
3. Once deployment is complete, your app will be available at `https://your-app-name.onrender.com`
Your app is now live! Go to: `https://your-app-name.onrender.com`

### Database Migrations

Migrations run automatically during deployment via the Dockerfile CMD. Check the **Logs** tab to confirm they completed successfully.
### Access Your Application

Your app is now live! Go to: `https://your-app-name.onrender.com`

## Troubleshooting

### App crashes after deployment

1. **Check logs**: Go to your Render dashboard → Web Service → Logs
2. **Common issues**:
   - `APP_KEY` not set or incorrect format
   - Database connection parameters wrong
   - Missing environment variables

### Database connection errors

- Verify database credentials in environment variables
- Ensure the PostgreSQL service is in the same region
- Check database URL format is correct

### Assets not loading (CSS/JS broken)

- Verify npm build completed: Check logs for `npm run build`
- May require explicit build command in Render settings

### Migrations failing

- Check `RENDER_DEPLOYMENT.md` for database setup
- Verify PostgreSQL service is fully initialized before migrations run

## Environment Variables Reference

| Variable | Purpose | Example |
|----------|---------|---------|
| `APP_NAME` | Application name | Mini Issue Tracker |
| `APP_ENV` | Environment | production |
| `APP_DEBUG` | Debug mode | false |
| `APP_KEY` | Encryption key | base64:xxxxx |
| `APP_URL` | Application URL | https://your-app.onrender.com |
| `DB_CONNECTION` | Database type | pgsql |
| `DB_HOST` | Database host | your-db.c.postgres.render.com |
| `SESSION_DRIVER` | Session handler | cookie |
| `CACHE_STORE` | Cache backend | file |
| `LOG_CHANNEL` | Logging channel | stderr |

## Additional Resources

- [Render Documentation](https://render.com/docs)
- [Laravel Deployment Guide](https://laravel.com/docs/deployment)
- [Docker Guide for Laravel](https://laravel.com/docs/installation#docker-installation)

## Quick Reference: Render Dashboard

- **Web Service Logs**: Troubleshoot deployment issues
- **Environment**: Manage environment variables
- **Deploys**: View deployment history
- **Settings**: Update configuration

---

Good luck with your deployment! 🚀
